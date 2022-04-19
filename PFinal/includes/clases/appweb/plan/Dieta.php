<?php
namespace appweb\plan;

use appweb\Aplicacion;

class Dieta {
    // ==================== ATRIBUTOS ====================
    // ====================           ====================
    /** @var array Array con todos los desayuno */
    private $_desayunos;
    /** @var array Array con todas las comidas */
    private $_comidas;
    /** @var array Array con todas las cenas */
    private $_cenas;
    /** @var int String que contiene todos los desayunos */
    private $_tipo;
    /** @var date String que contiene todos las comidas */
    private $_fecha;

    // ==================== MÉTODOS ====================
    // ====================         ====================
    // Constructor
    private function __construct($desayunos, $comidas, $cenas, $tipo, $fecha) {
        $this->_desayunos = $desayunos; 
        $this->_comidas = $comidas; 
        $this->_cenas = $cenas;
        $this->_fecha = $fecha;
        $this->_tipo = $tipo;
    }
    // ==================== PUBLIC ====================
     /**
     * Método para crear una dieta. Devuelve una dieta nueva
     * @var int $tipo valores posibles: { 1 = perder peso, 2 = ganar peso, 3 = mantener peso }
     * @return Dieta|false 
     */
    public static function Dieta_ConstructorFalso($tipo) {
        $bd = Aplicacion::getInstance()->getConexionBd();
        // Si su dieta es la que ha seleccionado
        if (self::exists_type($bd, $tipo)) {
            // Muestra la dieta ya disponible
            $desayunos = self::select_rows($bd, 'id_desayuno');
            $comidas = self::select_rows($bd, 'id_almuerzo');
            $cenas = self::select_rows($bd, 'id_cena');
        }
        // Si su dieta es nueva
        else {
            // Rellena los arrays con comidas aleatorias
            $desayunos = self::llenar_random($bd, $tipo, "Desayuno");
            $comidas = self::llenar_random($bd, $tipo, "Comida");
            $cenas = self::llenar_random($bd, $tipo, "Cena");
            // Si algun array no se ha llenado devuelve false
            if (!$desayunos || !$comidas || !$cenas)
                return false;
            
            // Si la persona ya tiene una entrada en la tabla
            if (self::exists_id($bd)) {
                // Actualiza los valores de las comidas
                self::update_rows($bd, $desayunos, $comidas, $cenas, $tipo);
            }
            // Si la persona ha empezado de cero
            else {
                // Inserta en la tabla un nuevo id
                self::insert_rows($bd, $desayunos, $comidas, $cenas, $tipo);
            }
        }
        // Devuelve un usuario con sus nuevos atributos
        return new Dieta($desayunos, $comidas, $cenas, $tipo, date('Y-m-d'));
    }
    // ==================== PRIVATE ====================
    /**
     * Metodo que inserta en la base de datos los IDs de las comidas del usuario por fecha (a partir de hoy)
     * @var \mysqli $bd instancia de la base de datos
     * @var array $desayunos array de IDs de desayunos
     * @var array $comidas array de IDs de comidas
     * @var array $cenas array de IDs de cenas
     * @var int $dias numero de dias que se hace la dieta
     */
    private static function insert_rows($bd, $desayunos, $comidas, $cenas, $tipo, $dias = 7) {
        $long_query = "";
        $fecha = date('Y-m-d');
        for ($i = 0; $i < $dias; $i++) {
            $query = sprintf(
                "INSERT INTO dieta (id_usuario, fecha, id_desayuno, id_almuerzo, id_cena, tipo) VALUES (%d, '%s', %d, %d, %d, %d);",
                $_SESSION['id'], $fecha, $desayunos[$i], $comidas[$i], $cenas[$i], $tipo
            );
            $fecha = date('Y-m-d', strtotime($fecha . '+1 day'));
            $long_query .= $query;
        }
        if (!$bd->multi_query($long_query)) {
            echo "Falló la multiconsulta: (" . $bd->errno . ") " . $bd->error;
            return false;
        }
    }
    /**
     * Metodo que actualiza el campo de la tabla 'modificacion' con el parametro que le metas
     * @var \mysqli $bd instancia de la base de datos
     * @var array $desayunos array de IDs de desayunos
     * @var array $comidas array de IDs de comidas
     * @var array $cenas array de IDs de cenas
     * @var int $dias numero de dias que se hace la dieta
     */
    private static function update_rows($bd, $desayunos, $comidas, $cenas, $tipo, $dias = 7) {
        // Buscar la fecha mas antigua de su dieta
        $query = sprintf(
            "SELECT MIN(dieta.fecha) AS fecha FROM dieta WHERE dieta.id_usuario = %d",
            $_SESSION['id']
        );
        // Si la consulta da error tratar el error
        if (!($result = $bd->query($query)))
            return false;
        // Usar la primera fecha
        $fila = mysqli_fetch_assoc($result);
        // Libera la memoria
        $result->free();
        $fecha_antigua = $fila['fecha'];
        // Usa la fecha actual para actualizar las entradas
        $fecha_nueva = date('Y-m-d');
        $long_query = "";
        // Consulta para modificar los datos de la BD
        for ($i = 0; $i < $dias; $i++) { 
            $query = sprintf(
                "UPDATE dieta SET dieta.fecha = '%s', dieta.id_desayuno = %d, dieta.id_almuerzo = %d, dieta.id_cena = %d, dieta.tipo = %d WHERE dieta.id_usuario = %d AND dieta.fecha = '%s';",
                $fecha_nueva, $desayunos[$i], $comidas[$i], $cenas[$i], $tipo, $_SESSION['id'], $fecha_antigua
            );
            $long_query .= $query;
            $fecha_nueva = date('Y-m-d', strtotime($fecha_nueva . '+1 day'));
            $fecha_antigua = date('Y-m-d', strtotime($fecha_antigua . '+1 day'));
        }
        // Si la consulta da error tratar el error
        if (!$bd->multi_query($long_query)) {
            echo "Falló la multiconsulta: (" . $bd->errno . ") " . $bd->error;
            return false;
        }
    }
    /**
     * Metodo que mete en un array todos los IDs del tipo $id
     * @var \mysqli $bd instancia de la base de datos
     * @var string $id columna de la BD { id_desayuno, id_almuerzo, id_cena }
     * @return array|false
     */
    private static function select_rows($bd, $id) {
        $query = sprintf(
            "SELECT dieta.%s FROM dieta WHERE dieta.id_usuario = %d",
            $id, $_SESSION['id']
        );
        // Si la consulta da error tratar el error
        if (!($result = $bd->query($query)))
            return false;
        // Si no, mete en un array todas las descripciones
        $ret = array();
        while ($fila = mysqli_fetch_assoc($result))
            array_push($ret, $fila[$id]);
        // Liberar la memoria
        $result->free();
        return $ret;
    }
    /**
     * Metodo que devuelve si existe el id en la tabla
     * @var \mysqli $bd instancia de la base de datos
     * @return true|false
     */
    private static function exists_id($bd) {
        $query = sprintf(
            "SELECT dieta.id_usuario FROM dieta WHERE dieta.id_usuario = %d",
            $_SESSION['id']
        );
        // Si la consulta da error tratar el error
        if (!($result = $bd->query($query)))
            return false;
        $ret = $result->num_rows;
        $result->free();
        // Devuelve true si hay alguna fila con esas caracteristicas
        return $ret != 0;
    }

    /** 
     * Metodo pasa saber si el usuario ya tiene la dieta en la base de datos
     * @var \mysqli $bd instancia de la base de datos
     * @var int $tipo: tipo de dieta que se puede llevar {1 = Bajar peso, 2 = subir peso, 3 = mantener peso}
     * @return true|false
     */
    private static function exists_type($bd, $tipo) {
        // Busca si ya existe en la tabla 'planificacion' el tipo
        $query = sprintf(
            "SELECT dieta.tipo FROM dieta WHERE dieta.id_usuario = %d AND dieta.tipo = %d",
            $_SESSION['id'], $tipo
        );
        // Si la consulta da error tratar el error
        $result = $bd->query($query);
        $ret = $result->num_rows;
        $result->free();
        // Devuelve true si hay alguna fila con esas caracteristicas
        return $ret != 0;
    }
    /**
     * Metodo que llena un array de $dias elementos con informacion aleatoria de la $bd
     * @var \mysqli $bd instancia de la base de datos
     * @var int $tipo valores posibles: { 1 = perder peso, 2 = ganar peso, 3 = mantener peso }
     * @var string $horario valores posibles: { desayuno, comida, cena }
     * @var int $dias dias que se hace dieta
     * @return array|false 
     */
    private static function llenar_random($bd, $tipo, $horario, $dias = 7) {

        $src = self::llenar_array($bd, $tipo, $horario);
        // Si esta vacio no hace nada
        if (!$src)
            return false;
        // Crea un array
        $ret = array();
        $max_comidas = (count($src) >= $dias) ? $dias : ($dias % count($src)) + 1 ;
        // Coge una clave aleatoria del array
        $clave = array_rand($src, $max_comidas);
        // Por cada dia de la semana
        for ($i = 0; $i < $dias; $i++) {
            // En c++ sería: ret.push_back($src.at($clave.at(i)))
            $ret[] =  $src[$clave[$i % count($src)]];
        }
        return $ret;
    }
    /**
     * Metodo que rellena el un array con nombres de comidas de la base de datos
     * @var \mysqli $bd instancia de la base de datos
     * @var int $tipo valores posibles: { 1 = perder peso, 2 = ganar peso, 3 = mantener peso }
     * @var string $horario valores posibles: { desayuno, comida, cena }
     * @return array|false 
     */
    private static function llenar_array($bd, $tipo, $horario) {
        // Consulta que te devuelve descripciones de elementos que hay de ese tipo 
        $query = sprintf(
            "SELECT comidas.id_comida FROM comidas WHERE comidas.tipo = '%s' AND comidas.objetivo = %d",
            $horario, $tipo
        );
        // Si la consulta da error tratar el error
        if (!($result = $bd->query($query))) {
            error_log("Error BD ({$bd->errno}): {$bd->error}");
            exit();
        }
        // Si no, mete en un array todas las descripciones
        $ret = array();
        while ($fila = mysqli_fetch_assoc($result)) {
            array_push($ret, $fila['id_comida']);
        }
        $result->free();
        // Si no hay elementos en el array devuelve false
        if (empty($ret))
            return false;
        // En caso contrario devuelve el array
        return $ret;
    }

    public static function buscaDieta($id, &$dias, &$desayuno, &$almuerzo, &$cena){
        /** @var array Array con todos los IDs de desayuno */
        $IDs_desayunos = array();
        /** @var array Array con todas las IDs de comidas */
        $IDs_almuerzos = array();
        /** @var array Array con todas las IDs de cenas */
        $IDs_cenas = array();
        
        $bd = Aplicacion::getInstance()->getConexionBd();
        // 1.- Hay que coger la primera fecha y contar cuantos dias tiene la dieta para saber cuantas columnas tendra la tabla
        $query = sprintf(
            "SELECT dieta.fecha AS fecha FROM dieta WHERE dieta.id_usuario = %d",
            $id
        );
        // Hace la consulta
        if (!($result = $bd->query($query))) {
            return false;
        }
        // Coge el numero de dias
        $dias = $result->num_rows;
        // Coge la fecha de inicio de la dieta
        $fila = mysqli_fetch_assoc($result);
        $fecha = $fila['fecha'];
        // Libera la memoria
        $result->free();

        // 2.- Hay que conseguir todos los IDs de las comidas
        $query = sprintf(
            "SELECT dieta.id_desayuno, dieta.id_almuerzo, dieta.id_cena FROM dieta WHERE dieta.id_usuario = %d",
            $id
        );
        $result = $bd->query($query);

        while ($fila = mysqli_fetch_assoc($result)) {
            array_push($IDs_desayunos, $fila['id_desayuno']);
            array_push($IDs_almuerzos, $fila['id_almuerzo']);
            array_push($IDs_cenas, $fila['id_cena']);
        }
        $result->free();

        // 3.- Hay que conseguir todos los nombres de las comidas
        $desayuno = self::fill_array($bd, $IDs_desayunos);
        $almuerzo = self::fill_array($bd, $IDs_almuerzos);
        $cena = self::fill_array($bd, $IDs_cenas);

        return $fecha;
    }

    /**
     * Metodo que dados los IDs, devuelve un array de comidas
     * @var \mysqli $bd instancia de la base de datos
     * @var array $src array de enteros del que se obtienen los IDs
     * @return array|false 
     */
    private static function fill_array($bd, $src) {
        $ret = array();
        for ($i = 0; $i < count($src); $i++) { 
            $query = sprintf(
                "SELECT comidas.descripcion FROM comidas WHERE comidas.id_comida = %d",
                $src[$i]
            );
            $result = $bd->query($query);
            $fila = mysqli_fetch_assoc($result);
            array_push($ret, $fila['descripcion']);
            $result->free();
        }
        return $ret;
    }


}
?>