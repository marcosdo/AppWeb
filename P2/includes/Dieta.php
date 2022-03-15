<?php
namespace es\ucm\fdi\aw;

class Dieta {
    /// PUBLIC
    // Constructor
    private function __construct() {
        $desayunos = array(); 
        $comidas = array(); 
        $cenas = array();
        $sdesayuno = "";
        $scomida = "";
        $scena = "";
        
    }
    /**
     * @var 
     */
    public function crear($id, $objetivo) { 
        $BD = Aplicacion::getInstance()->getConnectionBd();
        $sqlselect = "SELECT * FROM planificacion WHERE planificacion.id_usuario = '$_SESSION[id]'";
        $resultado = $BD->query($sqlselect); 
        $fila = mysqli_fetch_assoc($resultado);

        
        if (is_null($fila["dobjetivo"]) || $fila["dobjetivo"] != $objetivo || is_null($fila["desayunos"]) || is_null($fila["comidas"]) || is_null($fila["cenas"])) {
            $desayunos_aux = array(); 
            $comidas_aux = array(); 
            $cenas_aux = array();
            
            
            fill_array($desayunos_aux, "desayuno", $objetivo, $BD);
            fill_array($comidas_aux, "comida", $objetivo, $BD);
            fill_array($cenas_aux, "cena", $objetivo, $BD);
                        
            
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

    private function fill_array(&$dest, $tipo, $objetivo, $BD) {
        // Consulta que te devuelve el numero de elementos que hay de ese tipo 
        $consulta = mysqli_query($BD, "SELECT dietas.descripcion FROM dietas WHERE dietas.tipo = '$tipo' AND dietas.Objetivo = $objetivo"); 
        while ($fila = mysqli_fetch_assoc($consulta)){
            array_push($dest, $fila['descripcion']);
        }
    }

    // Inserta siete (7) elementos en el array destino
    function fill_random(&$dest, $src, &$string) {
    // Si esta vacio no hace nada
    if (empty($src)) {
        return;
    }
    // Por cada dia de la semana
    for ($i = 0; $i < 7; $i++) {
        $clave = array_rand($src, 1); 
        $dest[] =  $src[$clave];
        $string .= $src[$clave];
        if($i != 6) $string .=  " | ";
    }
    }

function fill_frombd(&$dest, $string){
            $dest = explode(" | ", $string);
        }



   
    private static function inserta() {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO usuario (nombre, apellidos, correo, password, id_usuario, premium) VALUES ('%s', '%s', '%s', '%s', '%s', '%d')");
       
    }
    
    /** @var array Array con todas los desayuno */
    private $_desayunos;
    /** @var array Array con todas las comidas */
    private $_comidas;
    /** @var array Array con todas las cenas */
    private $_cenas;
    private $_sdesayuno;
    private $_scomida;
    private $_scena;
    
}
