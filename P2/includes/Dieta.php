<?php
namespace es\ucm\fdi\aw;

class Dieta {
    // ==================== ATRIBUTOS ====================
    // ====================           ====================
    /** @var array Array con todos los desayuno */
    private $_desayunos;
    /** @var array Array con todas las comidas */
    private $_comidas;
    /** @var array Array con todas las cenas */
    private $_cenas;
    /** @var json String que contiene todos los desayunos */
    private $_strdesayuno;
    /** @var json String que contiene todos las comidas */
    private $_strcomida;
    /** @var json String que contiene todos las cenas */
    private $_strcena;

    // ==================== MÉTODOS ====================
    // ====================         ====================
    // Constructor
    private function __construct($desayunos, $comidas, $cenas, $strdesayuno, $strcomida, $strcena) {
        $this->_desayunos = $desayunos; 
        $this->_comidas = $comidas; 
        $this->_cenas = $cenas;
        $this->_strdesayuno = $strdesayuno;
        $this->_strcomida = $strcomida;
        $this->_strcena = $strcena;
    }
    // ==================== PUBLIC ====================
     /**
     * Método para crear una dieta. Devuelve una dieta nueva
     * @var int $tipo valores posibles: { 1 = perder peso, 2 = ganar peso, 3 = mantener peso }
     * @return Dieta|false 
     */
    public static function Dieta_ConstructorFalso($tipo) {
        $bd = Aplicacion::getInstance()->getConexionBd();
        // Si la persona ya tiene una entrada en la tabla
        if (self::exists_id($bd)) {
            // Si su dieta es la que ha seleccionado
            if (self::exists_type($bd, $tipo)) {
                // Muestra la dieta ya disponible
                $desayunos = self::get_from_data($bd, "desayunos");
                $comidas = self::get_from_data($bd, "comidas");
                $cenas = self::get_from_data($bd, "cenas");
                // Meter info en jsons
                $json_desayunos = json_encode($desayunos);
                $json_comidas = json_encode($comidas);
                $json_cenas = json_encode($cenas);
            }
            // Si no, actualiza su dieta
            else {
                // Trae de la base de datos las descripciones de comidas y las mete en arrays
                $desayunos_aux = self::llenar_array($bd, $tipo, "Desayuno");
                $comidas_aux = self::llenar_array($bd, $tipo, "Comida");
                $cenas_aux = self::llenar_array($bd, $tipo, "Cena");
                // Si algun array no se ha llenado devuelve false
                if (!$desayunos_aux || !$comidas_aux || !$cenas_aux)
                    return false;
                // Rellena los arrays con comidas aleatorias
                $desayunos = self::llenar_random($desayunos_aux);
                $comidas = self::llenar_random($comidas_aux);
                $cenas = self::llenar_random($cenas_aux);
                // Si algun array no se ha llenado devuelve false
                if (!$desayunos || !$comidas || !$cenas)
                    return false;
                // Meter info en jsons
                $json_desayunos = json_encode($desayunos);
                $json_comidas = json_encode($comidas);
                $json_cenas = json_encode($cenas);
                // Actualiza los valores de las comidas
                self::update_comida($bd, "desayunos", $json_desayunos);
                self::update_comida($bd, "comidas", $json_comidas);
                self::update_comida($bd, "cenas", $json_cenas);
            }
        } 
        // Si no, crea una dieta a partir de las comidas de la base de datos, y crea la entrada
        else {
            // Trae de la base de datos las descripciones de comidas y las mete en arrays
            $desayunos_aux = self::llenar_array($bd, $tipo, "Desayuno");
            $comidas_aux = self::llenar_array($bd, $tipo, "Comida");
            $cenas_aux = self::llenar_array($bd, $tipo, "Cena");
            // Si algun array no se ha llenado devuelve false
            if (!$desayunos_aux || !$comidas_aux || !$cenas_aux)
                return false;
            // Rellena los arrays con comidas aleatorias
            $desayunos = self::llenar_random($desayunos_aux);
            $comidas = self::llenar_random($comidas_aux);
            $cenas = self::llenar_random($cenas_aux);
            // Si algun array no se ha llenado devuelve false
            if (!$desayunos || !$comidas || !$cenas)
                return false;
            // Meter info en jsons
            $json_desayunos = json_encode($desayunos);
            $json_comidas = json_encode($comidas);
            $json_cenas = json_encode($cenas);
            // Inserta en la tabla un nuevo id
            self::insert_row($bd, $tipo, $json_desayunos, $json_comidas, $json_cenas);
        }
        // Devuelve un usuario con sus nuevos atributos
        return new Dieta($desayunos, $comidas, $cenas, $json_desayunos, $json_comidas, $json_cenas);
    }
    // ==================== PRIVATE ====================
    /**
     * 
     * @var mysqli $bd instancia de la base de datos
     * @var int $tipo: tipo de dieta que se puede llevar {1 = Bajar peso, 2 = subir peso, 3 = mantener peso}
     * @var string $desayunos
     * @var string $comidas
     * @var string $cenas
     */
    private static function insert_row($bd, $tipo, $desayunos, $comidas, $cenas) {
        $query = sprintf(
            "INSERT INTO dieta (id_usuario, objetivo, desayunos, comidas, cenas) VALUES (%d, '%s', '%s', '%s', '%s')",
            $_SESSION['id'], $tipo, $desayunos, $comidas, $cenas
        );
        // Si la consulta da error tratar el error
        if (!$bd->query($query)) {
            error_log("Error BD ({$bd->errno}): {$bd->error}");
            exit();
        }
    }
    /**
     * 
     * @var mysqli $bd instancia de la base de datos
     */
    private static function get_from_data($bd, $horario) {
        $query = sprintf(
            "SELECT dieta.%s FROM dieta WHERE dieta.id_usuario = %d",
            $horario, $_SESSION['id']
        );
        // Si la consulta da error tratar el error
        if (!($result = $bd->query($query))) {
            error_log("Error BD ({$bd->errno}): {$bd->error}");
            exit();
        }
        $result = mysqli_fetch_assoc($result);
        $array = json_decode($result[$horario]);
        return $array;
    }
    /**
     * Metodo que devuelve si existe el id en la tabla
     * @var mysqli $bd instancia de la base de datos
     * @return true|false
     */
    private static function exists_id($bd) {
        $query = sprintf(
            "SELECT dieta.id_usuario FROM dieta WHERE dieta.id_usuario = %d",
            $_SESSION['id']
        );
        // Si la consulta da error tratar el error
        if (!($result = $bd->query($query))) {
            error_log("Error BD ({$bd->errno}): {$bd->error}");
            exit();
        }
        return $result->num_rows != 0;
    }

    /** 
     * Metodo pasa saber si el usuario ya tiene la dieta en la base de datos
     * @var mysqli $bd instancia de la base de datos
     * @var int $tipo: tipo de dieta que se puede llevar {1 = Bajar peso, 2 = subir peso, 3 = mantener peso}
     * @return true|false
     */
    private static function exists_type($bd, $tipo) {
        // Busca si ya existe en la tabla 'planificacion' el tipo
        $query = sprintf(
            "SELECT dieta.objetivo FROM dieta WHERE dieta.id_usuario = %d AND dieta.objetivo = %d",
            $_SESSION['id'], $tipo
        );
        // Si la consulta da error tratar el error
        if (!($result = $bd->query($query))) {
            error_log("Error BD ({$bd->errno}): {$bd->error}");
            exit();
        }
        // Devuelve true si hay alguna fila con esas caracteristicas
        return $result->num_rows != 0;
    }
    /**
     * Metodo que actualiza el campo de la tabla 'modificacion' con el parametro que le metas
     * @var mysqli $bd instancia de la base de datos
     * @var string $horario valores posibles: { desayuno, comida, cena }
     * @var string $json datos a meter en la BD
     */
    private static function update_comida($bd, $horario, $json) {
        // Consulta para modificar los datos de la BD
        $query = sprintf(
            "UPDATE dieta SET dieta.%s = '%s' WHERE dieta.id_usuario = %d",
            $horario, $json, $_SESSION['id']
        );
        // Si la consulta da error tratar el error
        if (!$bd->query($query)) {
            error_log("Error BD ({$bd->errno}): {$bd->error}");
            exit();
        }
    }
    /**
     * Metodo que rellena el un array con nombres de comidas de la base de datos
     * @var mysqli $bd instancia de la base de datos
     * @var int $tipo valores posibles: { 1 = perder peso, 2 = ganar peso, 3 = mantener peso }
     * @var string $horario valores posibles: { desayuno, comida, cena }
     * @return array|false 
     */
    private static function llenar_array($bd, $tipo, $horario) {
        // Consulta que te devuelve descripciones de elementos que hay de ese tipo 
        $query = sprintf(
            "SELECT comidas.descripcion FROM comidas WHERE comidas.tipo = '%s' AND comidas.objetivo = %d",
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
            array_push($ret, $fila['descripcion']);
        }
        // Si no hay elementos en el array devuelve false
        if (empty($ret))
            return false;
        // En caso contrario devuelve el array
        return $ret;
    }
    /**
     * Metodo que llena un array de 7 elementos con informacion aleatoria de $src
     * @var array $src array de donde se cogen los elementos
     * @return array|false 
     */
    private static function llenar_random($src) {
        // Si esta vacio no hace nada
        if (empty($src))
            return false;
        // Crea un array
        $ret = array();
        // Por cada dia de la semana
        for ($i = 0; $i < 7; $i++) {
            // Coge una clave aleatoria del array
            $clave = array_rand($src, 1);
            // En c++ sería: ret.push_back($src.at($clave))
            $ret[] =  $src[$clave];
        }
        return $ret;
    }
}

?>