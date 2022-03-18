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


    public function comprobarRutina() { 
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM planificacion WHERE id_usuario = '%d'", $conn->real_escape_string($this->_id));
        $rs = $conn->query($query); 
        if($rs){
            if($rs->num_rows > 0){
                $fila = $rs->fetch_assoc();
                if($fila['eobjetivo'] != $this->_objetivo || $fila['nivel'] != $this->_nivel || 
                    $fila['dias'] != $this->_dias)
                    $this->crearRutina(true);
                    $rs->free();
            }
            else {
                $this->crearRutina(false); 
                $rs->free();
            }
        }
        else error_log("Error BD ({$this->conn->errno}): {$this->conn->error}");
        
    }

    private function crearRutina($update){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $cont = 1;  
        for ($i = 1; $i < $this->_dias+1; $i++) {
            $arrayaux = array();
            if ($i == 4) $cont = 1;
            if ($i >= 1 && $i <= 3) {
               $this->fill_array($cont, 2, $arrayaux);
            }
            else {
                $this->fill_array($cont, 3, $arrayaux);
            }
           array_push($this->_array, $arrayaux);
        }
        $guardar = json_encode($this->_array);
        if(!$update) {
            $query = sprintf("INSERT INTO planificacion (id_usuario, rutina, eobjetivo, dias, nivel) VALUES ('%d', '%s', '%d', 
            '%d', '%s')", $this->_id, $conn->real_escape_string($guardar), $this->_objetivo, $this->_dias, $conn->real_escape_string($this->_nivel));
        }
        else{
            $query = sprintf("UPDATE planificacion SET planificacion.rutina = '%s', planificacion.nivel = '%s' , planificacion.dias = '%d',  
            planificacion.eobjetivo = '%d'", $conn->real_escape_string($guardar), $conn->real_escape_string($this->_nivel), $this->_dias, $this->_objetivo);
        }
        if ($conn->query($query)) return true;
        else error_log("Error BD ({$conn->errno}): {$conn->error}");
    }


    private function fill_array(&$cont, $nveces , &$arrayaux) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        for ($i = 0; $i < $nveces; $i++){
            $j = 0;
            $musculo = $this->_muscs[$cont];
            $query = sprintf("SELECT * FROM ejercicios WHERE musculo = '%s'", $conn->real_escape_string($musculo)); 
            $rs = $conn->query($query);
            while ($fila = $rs->fetch_assoc()){
                if($j < $this->_ejerciciosdia){
                    array_push($arrayaux, $fila['nombre']); 
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