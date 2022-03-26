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

    public function comprobarRutina() { 
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM rutina WHERE id_usuario = '%d'", $conn->real_escape_string($this->_id));
        $rs = $conn->query($query); 
        if($rs){
            if($rs->num_rows > 0){ // el usuario esta en la tabla rutina
                while($fila = $rs->fetch_assoc()){
                    if($fila['activa']){
                        $query = sprintf("UPDATE rutina SET rutina.activa = '%d' WHERE rutina.id_rutina' = '%d",  false, $fila['id_rutina']); // desactivar la activa la rutina activa
                        if ($conn->query($query)) return true;
                    }
                } 
                $antigua = false;
                while($fila = $rs->fetch_assoc()){
                     if($fila['objetivo'] == $this->_objetivo && $fila['nivel'] == $this->_nivel &&  $fila['dias'] == $this->_dias) {
                        $query = sprintf("UPDATE rutina SET rutina.activa = '%d' WHERE rutina.id_rutina' = '%d",  true, $fila['id_rutina']); // comprueba si la nueva rutina es igual que una antigua
                        if ($conn->query($query)) return true;
                        $antigua = true;
                     }
                }
                if($antigua == false){
                    $this->crearRutina(true);
    
                }
            }   
            else{ // no esta el usuario y lo inserta
                $this->_id_rutina = 1;
                $query = sprintf("INSERT INTO rutina (id_rutina, activa, id_usuario, nivel, dias, objetivo) VALUES ('%d', '%d', '%d', 
                '%s', '%d','%d')",1, true, $this->_id,  $conn->real_escape_string($this->_nivel), $this->_dias, $this->_objetivo);
        
                 if ($conn->query($query)){
                     $this->_id_rutina = $conn->insert_id;
                 } return true;
           
                $this->crearRutina(true);
            }
           
            $rs->free();
        }
        else error_log("Error BD ({$this->conn->errno}): {$this->conn->error}");
        
    }

    private function crearRutina($update){
        $cont = 1;  
        $conn = Aplicacion::getInstance()->getConexionBd();

        for ($i = 1; $i < $this->_dias+1; $i++) {
            
            $arrayaux = array();
            if ($i == 4) $cont = 1;
            if ($i >= 1 && $i <= 3) {
               $this->fill_array($cont, 2, $i);
            }
            else {
                $this->fill_array($cont, 3, $i);
            }
        }
    }


    private function fill_array(&$cont, $nveces, $dia) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        for ($i = 0; $i < $nveces; $i++){
            $j = 0;
            $musculo = $this->_muscs[$cont];
            $query = sprintf("SELECT * FROM ejercicios WHERE musculo = '%s'", $conn->real_escape_string($musculo)); 
            $rs = $conn->query($query);
            while ($fila = $rs->fetch_assoc()){
                if($j < $this->_ejerciciosdia){
                    $query= sprintf("INSERT INTO contiene (id_rutina, id_ejercicio, dia, repeticiones) VALUES ('%d', '%d', '%d', 
                    '%d',)", 1, $fila['id_ejercicio'], $dia, 10);
                    if ($conn->query($query)) return true;
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