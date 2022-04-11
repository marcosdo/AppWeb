<?php
namespace appweb\plan;

use appweb\Aplicacion;

class Rutina {
    
    private $_ejerciciosdia;
    private $_nivel;
    private $_objetivo;
    private $_dias;
    private $_muscs;
    private $_id_rutina;
    private $antigua;

    public static function crea($id, $objetivo, $nivel, $dias){
        $rutina = new Rutina($id, $objetivo, $nivel, $dias);
        return $rutina;
    }
    
    public static function comprobarRutina($rutina) { 
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM rutina WHERE id_usuario = '%d'", $rutina->_id);
        $rs = $conn->query($query); 
       
        if($rs){
            if($rs->num_rows > 0){ // el usuario esta en la tabla rutina
                while($fila = $rs->fetch_assoc()){ //desactivar los activa
                    $desactiva = sprintf("UPDATE rutina SET rutina.activa = '%d' WHERE rutina.id_usuario ='%d'",  false, $rutina->_id); // desactivar la activa la rutina activa
                    $conn->query($desactiva);
                } 
               
                $antigua = false;
                $q = sprintf("SELECT * FROM rutina WHERE id_usuario = '%d'", $rutina->_id);
                $res = $conn->query($q);
                while($fila = $res->fetch_assoc()){ //ya tiene una rutina igual
                     if($fila['objetivo'] == $rutina->_objetivo && $fila['nivel'] == $rutina->_nivel &&  $fila['dias'] == $rutina->_dias) {
                        $mismarutina = sprintf("UPDATE rutina SET rutina.activa = '%d' WHERE rutina.id_rutina = '%d'",  true, $fila['id_rutina']); // comprueba si la nueva rutina es igual que una antigua
                        $rutina->_id_rutina = $fila['id_rutina'];
                        if ($conn->query($mismarutina));
                        $antigua = true;
                     }
                }
                if($antigua == false){ //el usuario no tiene una rutina igual en la bd
                    $query = sprintf("INSERT INTO rutina (activa, id_usuario, nivel, dias, objetivo) VALUES ('%d', '%d', 
                    '%s', '%d','%d')", true, $rutina->_id,  $conn->real_escape_string($rutina->_nivel), $rutina->_dias, $rutina->_objetivo);
                    if ($conn->query($query)){} 
                    $q = sprintf("SELECT * FROM rutina WHERE id_usuario = '%d'", $conn->real_escape_string($rutina->_id));
                    $rs = $conn->query($q); 
                    while($fila = $rs->fetch_assoc()){
                        if($fila['objetivo'] == $rutina->_objetivo && $fila['nivel'] == $rutina->_nivel &&  $fila['dias'] == $rutina->_dias){
                             $rutina->_id_rutina = $fila['id_rutina'];
                    }
                    
                }
                self::crearRutina($rutina);
    
                }
            }   
            else{ // no esta el usuario y lo inserta
         
                $query = sprintf("INSERT INTO rutina (activa, id_usuario, nivel, dias, objetivo) VALUES ('%d', '%d', 
                '%s', '%d','%d')", true, $rutina->_id,  $conn->real_escape_string($rutina->_nivel), $rutina->_dias, $rutina->_objetivo);
                if ($conn->query($query)){} 

                $q = sprintf("SELECT * FROM rutina WHERE id_usuario = '%d'", $conn->real_escape_string($rutina->_id));
                $rs = $conn->query($q); 
                while($fila = $rs->fetch_assoc()){
                    if($fila['objetivo'] == $rutina->_objetivo && $fila['nivel'] == $rutina->_nivel &&  $fila['dias'] == $rutina->_dias){
                         $rutina->_id_rutina = $fila['id_rutina'];
                }
             }
                self::crearRutina($rutina);
            }
           
            $rs->free();
        }
        else error_log("Error BD ({$conn->errno}): {$conn->error}"); 
    }

    private static function crearRutina($rutina){
        $cont = 1;          
        for ($i = 1; $i < $rutina->_dias+1; $i++) {
            if ($i == 4) $cont = 1;
            if ($i >= 1 && $i <= 3) {
               self::fill_array($cont, 2, $i, $rutina); //1,2,1
            }
            else {
                self::fill_array($cont, 3, $i, $rutina);
            }
        }
    }


    private static function fill_array(&$cont, $nveces, $dia, $rutina) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        for ($i = 0; $i < $nveces; $i++){ //2
            $j = 0;
            $musculo = $rutina->_muscs[$cont];
            $query = sprintf("SELECT * FROM ejercicios WHERE musculo = '%s'", $conn->real_escape_string($musculo)); 
            $rs = $conn->query($query);
            while ($fila = $rs->fetch_assoc()){
                if($j < 2){
                    $repeticiones = self:: calculadoraRepeticiones($rutina, $fila['tipo']);
                    $query= sprintf("INSERT INTO contiene (id_rutina, id_ejercicio, dia, repeticiones) VALUES ('%d', '%d', '%d', 
                    '%d')",  $rutina->_id_rutina , $fila['id_ejercicio'], $dia, $repeticiones);
                     if ($conn->query($query));
                } 
                $j++;
            }
            $rs->free();
            $cont++;
        } 
    }

    private static function calculadoraRepeticiones($rutina, $tipo){
        switch($tipo){
            case 0:
                if($rutina->_objetivo == 1) $reps = 6;
                else if($rutina->_objetivo == 2) $reps = 8;
                else if($rutina->_objetivo == 3) $reps = 10;
                break;
            case 1:
                if($rutina->_objetivo == 1) $reps = 8;
                else if($rutina->_objetivo == 2) $reps = 10;
                else if($rutina->_objetivo == 3) $reps = 12;
                break;
            case 2:
                $reps = 14;
                break;
        }
        return $reps;
    }

    public static function buscaRutina(&$obj, &$arrayreps, &$usuario){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM rutina WHERE rutina.id_usuario = '%d' AND rutina.activa = '%d'", $usuario, 1);
        $rs = $conn->query($query);
        if($rs != null){
            while( $fila = $rs->fetch_assoc()){
                if($fila['activa'] == true){
                    $objetivo = $fila['objetivo'];
                    $rutinaid = $fila['id_rutina'];
                }
            }
            $obj = $objetivo;
            $q = sprintf("SELECT * FROM contiene WHERE contiene.id_rutina = '%d'", $rutinaid);
            $t = $conn->query($q); 
            $arrayaux = [];
            $dia1 = array();
            $dia2 = array();
            $dia3 = array();
            $dia4 = array();
            $dia5 = array();
            $dia1r = array();
            $dia2r = array();
            $dia3r = array();
            $dia4r = array();
            $dia5r = array();
        
            while($fila = $t->fetch_assoc()){
            
                if($fila['dia'] == 1){
                    array_push($dia1r, $fila['repeticiones']);
                    $c = sprintf("SELECT * FROM ejercicios WHERE ejercicios.id_ejercicio = '%d'", $fila['id_ejercicio']);
                    $rs = $conn->query($c);
                    $fila = $rs->fetch_assoc();
                    array_push($dia1, $fila['nombre']);
                }
                else if ($fila['dia'] == 2){
                    array_push($dia2r, $fila['repeticiones']);
                    $c = sprintf("SELECT * FROM ejercicios WHERE ejercicios.id_ejercicio = '%d'", $fila['id_ejercicio']);
                    $rs = $conn->query($c);
                    $fila = $rs->fetch_assoc();
                    array_push($dia2, $fila['nombre']);
                }
                else if ($fila['dia'] == 3){
                    array_push($dia3r, $fila['repeticiones']);
                    $c = sprintf("SELECT * FROM ejercicios WHERE ejercicios.id_ejercicio = '%d'", $fila['id_ejercicio']);
                    $rs = $conn->query($c);
                    $fila = $rs->fetch_assoc();
                    array_push($dia3, $fila['nombre']);
                }
                else if ($fila['dia'] == 4){
                    array_push($dia4r, $fila['repeticiones']);
                    $c = sprintf("SELECT * FROM ejercicios WHERE ejercicios.id_ejercicio = '%d'", $fila['id_ejercicio']);
                    $rs = $conn->query($c);
                    $fila = $rs->fetch_assoc();
                    array_push($dia4, $fila['nombre']);
                }
                else{
                    array_push($dia5r, $fila['repeticiones']);
                    $c = sprintf("SELECT * FROM ejercicios WHERE ejercicios.id_ejercicio = '%d'", $fila['id_ejercicio']);
                    $rs = $conn->query($c);
                    $fila = $rs->fetch_assoc();
                    array_push($dia5, $fila['nombre']);
                }
            }
            if(!empty($dia1)) array_push($arrayaux, $dia1);
            if(!empty($dia2)) array_push($arrayaux, $dia2);
            if(!empty($dia3)) array_push($arrayaux, $dia3);
            if(!empty($dia4)) array_push($arrayaux, $dia4);
            if(!empty($dia5)) array_push($arrayaux, $dia5);

            if(!empty($dia1r)) array_push($arrayreps, $dia1r);
            if(!empty($dia2r)) array_push($arrayreps, $dia2r);
            if(!empty($dia3r)) array_push($arrayreps, $dia3r);
            if(!empty($dia4r)) array_push($arrayreps, $dia4r);
            if(!empty($dia5r)) array_push($arrayreps, $dia5r);

            $rs->free();
        }
        return $arrayaux;
    }


    public static function devolverEjercicio($id_usuario, $dia, $pos){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM rutina WHERE rutina.id_usuario = '%d' AND rutina.activa = '%d'", $id_usuario, 1);
        $rs = $conn->query($query); 
        while($fila = $rs->fetch_assoc()){ 
            $query2 = sprintf("SELECT * FROM contiene WHERE contiene.id_rutina = '%d' AND  contiene.dia = '%d'", $fila['id_rutina'], $dia);
            $rs2 = $conn->query($query2); 
            $i = 0;
            while($i < $pos && $fila2 = $rs2->fetch_assoc()){
                $i++;
                if($i == $pos) $ejercicio = $fila2['id_ejercicio'];
            }
            $query3 = sprintf("SELECT ejercicio.nombre FROM ejercicios WHERE ejercicio.id_ejercicio = '%d'", $ejercicio);
            $rs3 = $conn->query($query3); 
        }   
        return $rs3;
    }

    public static function diasUsuario($id_usuario){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM rutina WHERE rutina.id_usuario = '%d' AND rutina.activa = '%d'", $id_usuario, 1);
        $rs = $conn->query($query); 
        $dias = 0;
        while($fila = $rs->fetch_assoc()){ 
            $dias = $fila['dias'];
        }
        return $dias;
    }

    public static function ejerciciosxDia($id_usuario, $dia){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM rutina WHERE rutina.id_usuario = '%d' AND rutina.activa = '%d'", $id_usuario, 1);
        $rs = $conn->query($query); 
        while($fila = $rs->fetch_assoc()){ 
            $query2 = sprintf("SELECT COUNT(*) FROM contiene WHERE contiene.id_rutina = '%d' AND contiene.dia = '%d'", $fila['id_rutina'], $dia);
            $rs2 = $conn->query($query2);  
            $ejerciciosxdia = $rs2->num_rows;
       }
        return $ejerciciosxdia;
    }

    public function __construct($id, $objetivo, $nivel, $dias) {
        $this->_nivel = $nivel;
        $this->_id = $id;
        $this->_objetivo = $objetivo;
        $this->_dias = $dias;
        $this->_array = array();
        switch ($this->_nivel) {
            case "P": $this->_ejerciciosdia = 2; break;
            case "M": $this->_ejerciciosdia = 3; break;
            case "A": $this->_ejerciciosdia = 4; break;
        }
        $this->_muscs = array(
            1 => "Pecho",
            2 => "Hombro",
            3 => "Espalda",
            4 => "Biceps",
            5 => "Pierna",
            6 => "Triceps",
        );
    }
}