<?php
namespace es\ucm\fdi\aw;

class Rutina {
    
    private $_ejerciciosdia;
    private $_nivel;
    private $_objetivo;
    private $_id;
    private $_dias;
    private $_muscs;
    private $array;
    private $_id_rutina;
    private $antigua;

    public function comprobarRutina() { 
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM rutina WHERE id_usuario = '%d'", $this->_id);
        $rs = $conn->query($query); 
       
        if($rs){
            if($rs->num_rows > 0){ // el usuario esta en la tabla rutina
                while($fila = $rs->fetch_assoc()){ //desactivar los activa
                    $desactiva = sprintf("UPDATE rutina SET rutina.activa = '%d' WHERE rutina.id_usuario ='%d'",  false, $this->_id); // desactivar la activa la rutina activa
                    $conn->query($desactiva);
                } 
               
                $antigua = false;
                $q = sprintf("SELECT * FROM rutina WHERE id_usuario = '%d'", $this->_id);
                $res = $conn->query($q);
                while($fila = $res->fetch_assoc()){ //ya tiene una rutina igual
                     if($fila['objetivo'] == $this->_objetivo && $fila['nivel'] == $this->_nivel &&  $fila['dias'] == $this->_dias) {
                        $mismarutina = sprintf("UPDATE rutina SET rutina.activa = '%d' WHERE rutina.id_rutina = '%d'",  true, $fila['id_rutina']); // comprueba si la nueva rutina es igual que una antigua
                        $this->_id_rutina = $fila['id_rutina'];
                        if ($conn->query($mismarutina));
                        $antigua = true;
                     }
                }
                if($antigua == false){ //el usuario no tiene una rutina igual en la bd
                    $query = sprintf("INSERT INTO rutina (activa, id_usuario, nivel, dias, objetivo) VALUES ('%d', '%d', 
                    '%s', '%d','%d')", true, $this->_id,  $conn->real_escape_string($this->_nivel), $this->_dias, $this->_objetivo);
                    if ($conn->query($query)){} 
                    $q = sprintf("SELECT * FROM rutina WHERE id_usuario = '%d'", $conn->real_escape_string($this->_id));
                    $rs = $conn->query($q); 
                    while($fila = $rs->fetch_assoc()){
                        if($fila['objetivo'] == $this->_objetivo && $fila['nivel'] == $this->_nivel &&  $fila['dias'] == $this->_dias){
                             $this->_id_rutina = $fila['id_rutina'];
                    }
                    
                }
                $this->crearRutina(true);
    
                }
            }   
            else{ // no esta el usuario y lo inserta
         
                $query = sprintf("INSERT INTO rutina (activa, id_usuario, nivel, dias, objetivo) VALUES ('%d', '%d', 
                '%s', '%d','%d')", true, $this->_id,  $conn->real_escape_string($this->_nivel), $this->_dias, $this->_objetivo);
                if ($conn->query($query)){} 

                $q = sprintf("SELECT * FROM rutina WHERE id_usuario = '%d'", $conn->real_escape_string($this->_id));
                $rs = $conn->query($q); 
                while($fila = $rs->fetch_assoc()){
                    if($fila['objetivo'] == $this->_objetivo && $fila['nivel'] == $this->_nivel &&  $fila['dias'] == $this->_dias){
                         $this->_id_rutina = $fila['id_rutina'];
                }
             }
                $this->crearRutina(true);
            }
           
            $rs->free();
        }
        else error_log("Error BD ({$this->conn->errno}): {$this->conn->error}");
        
    }

    private function crearRutina($update){
        $cont = 1;  
      //  $conn = Aplicacion::getInstance()->getConexionBd();
        
        for ($i = 1; $i < $this->_dias+1; $i++) {
            
            if ($i == 4) $cont = 1;
            if ($i >= 1 && $i <= 3) {
               $this->fill_array($cont, 2, $i); //1,2,1
               
            }
            else {
                $this->fill_array($cont, 3, $i);
            }
        }
    }


    private function fill_array(&$cont, $nveces, $dia) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        for ($i = 0; $i < $nveces; $i++){ //2
            $j = 0;
            $musculo = $this->_muscs[$cont];
            $query = sprintf("SELECT * FROM ejercicios WHERE musculo = '%s'", $conn->real_escape_string($musculo)); 
            $rs = $conn->query($query);
            while ($fila = $rs->fetch_assoc()){
                if($j < 2){
                    $query= sprintf("INSERT INTO contiene (id_rutina, id_ejercicio, dia, repeticiones) VALUES ('%d', '%d', '%d', 
                    '%d')",  $this->_id_rutina , $fila['id_ejercicio'], $dia, 10);
                     if ($conn->query($query));
                } 
                $j++;
            }
            $rs->free();
            $cont++;
        } 
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