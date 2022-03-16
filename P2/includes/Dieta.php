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
    /** @var string String que contiene todos los desayunos de la semana separados por '|' */
    private $_strdesayuno;
    /** @var string String que contiene todos las comidas de la semana separados por '|' */
    private $_strcomida;
    /** @var string String que contiene todos las cenas de la semana separados por '|' */
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
     * Metodo pasa saber si el usuario ya tiene la dieta en la base de datos
     * 
     * @var int $tipo: tipo de dieta que se puede llevar {1 = Bajar peso, 2 = subir peso, 3 = mantener peso}
     * 
     * @return string[]|false
     */
    public static function exists_type($tipo) {
        // Coge la instancia de la base de datos
        $bd = Aplicacion::getInstance()->getConexionBd();
        // Hace una consulta para coger los desayunos
        $query_desayunos = self::query_comida($bd, $tipo, "desayuno");
        $query_comidas = self::query_comida($bd, $tipo, "comida");
        $query_cenas = self::query_comida($bd, $tipo, "cena");
        // Si no devuelve nada, no existen
        if (!$query_desayunos || !$query_comidas || !$query_cenas)
            return false;
        // Si existen, las devuelve en forma de arrah
        return array($query_desayunos, $query_comidas, $query_cenas);
    }
    /**
     * Método para crear una dieta. Devuelve una dieta nueva
     * 
     * @var int $tipo 
     * 
     * @return Dieta|false 
     */
    public static function create_dieta($tipo) {
        $bd = Aplicacion::getInstance()->getConexionBd();

        // Trae de la base de datos los desayunos y los mete
        $desayunos_aux = self::llenar_array($bd, $tipo, "Desayuno");
        $comidas_aux = self::llenar_array($bd, $tipo, "Comida");
        $cenas_aux = self::llenar_array($bd, $tipo, "Cena");

        if (!$desayunos_aux || !$comidas_aux || !$cenas_aux)
            return false;

        // Rellena los arrays con comidas aleatorias
        $desayunos = self::llenar_random($desayunos_aux);
        $comidas = self::llenar_random($comidas_aux);
        $cenas = self::llenar_random($cenas_aux);

        if (!$desayunos || !$comidas || !$cenas)
            return false;

        return new Dieta($desayunos, $comidas, $cenas, "", "", "");
    }

    public function muestra_dieta() {
        
    }
/*
    public function crear($id, $objetivo) { 
        $BD = Aplicacion::getInstance()->getConexionBd();
        $sqlselect = "SELECT * FROM planificacion WHERE planificacion.id_usuario = '$_SESSION[id]'";
        $resultado = $BD->query($sqlselect); 
        $fila = mysqli_fetch_assoc($resultado);

        
        if (is_null($fila["dobjetivo"]) || $fila["dobjetivo"] != $objetivo || is_null($fila["desayunos"]) || is_null($fila["comidas"]) || is_null($fila["cenas"])) {
            $desayunos_aux = array(); 
            $comidas_aux = array(); 
            $cenas_aux = array();


            // Rellena los arrays con comidas aleatorias   
            fill_random($desayunos, $desayunos_aux, $des);
            fill_random($comidas, $comidas_aux, $coms);
            fill_random($cenas, $cenas_aux, $cens);
        
            $query = "UPDATE planificacion SET planificacion.desayunos = '$des', planificacion.comidas = '$coms', 
            planificacion.cenas = '$cens' WHERE planificacion.id_usuario = '$_SESSION[id_usuario]'";
            mysqli_query($BD, $query);
        }
        
        else {
            $des = $fila["desayunos"];
            $coms = $fila["comidas"];
            $cens = $fila["cenas"];
        
            fill_frombd($desayunos, $des);
            fill_frombd($comidas, $coms);
            fill_frombd($cenas, $cens);
        }

    }*/

    // ==================== PRIVATE ====================

    /** 
     * Método que devuelve el string de comidas en funcion del horario que metas
     * @var mysql $bd instancia de la base de datos
     * @var int $tipo valores posibles: {1, 2, 3}
     * @var string $horario valores posibles: {desayuno, comida, cena}
     * 
     * @return query|false 
     */
    private function query_comida($bd, $tipo, $horario) {
        $query = sprintf(
            "SELECT planificacion.%s FROM planificacion WHERE planificacion.id_usuario = %s AND dobjetivo = %s",
            $horario, $_SESSION['id'], $tipo
        );
        $result = $bd->query($query);
        if (!$result) {
            error_log("Error BD ({$bd->errno}): {$bd->error}");
            return false;
        }
        return $result;
    }


    /** Funcion que coge de la base de datos las comidas segun su $objetivo y las mete en el array $dest
     * @var array $dest lista de comida de Lunes-Domingo
     * @var int $objetivo = [1, 2, 3]
     */
    private function posibleComida (&$dest, $objetivo){

    }

    /**
     * @var
     */
    private function buscarDieta($id, $objetivo) {

     }

    // ~~~~~~~~~~~~~~~~~~~~ FUNCIONES AUXILIARES ~~~~~~~~~~~~~~~~~~~~
    /**
     * Metodo que rellena el un array con informacion de la base de datos
     * 
     * @var mysqli $bd instancia de la base de datos
     * @var int $tipo valores posibles: {1, 2, 3}
     * @var string $horario valores posibles: {desayuno, comida, cena}
     * 
     * @return string[]|false 
     */
    private function llenar_array($bd, $tipo, $horario) {
        // Consulta que te devuelve el numero de elementos que hay de ese tipo 
        $query = sprintf(
            "SELECT dietas.descripcion FROM dietas WHERE dietas.tipo = %s AND dietas.objetivo = %d",
            $horario, $tipo
        );

        $result = $bd->query($query);
        if (!$result)
            return false;

        $ret = array();
        while ($fila = mysqli_fetch_assoc($result)) {
            array_push($ret, $fila['descripcion']);
        }
        return $ret;
    }

    /**
     * Metodo que llena un array de 7 elementos con informacion aleatoria de $src
     * @var array $src
     * 
     * @return string[]|false 
     */
    function llenar_random($src) {
        // Si esta vacio no hace nada
        if (empty($src)) {
            return false;
        }

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

    private static function inserta() {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO usuario (nombre, apellidos, correo, password, id_usuario, premium) VALUES ('%s', '%s', '%s', '%s', '%s', '%d')");
       
    }
}

?>