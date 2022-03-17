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
        $BD = Aplicacion::getInstance()->getConexionBd();
        $sqlselect = "SELECT * FROM planificacion WHERE planificacion.id_usuario = '$this->_id'";
        $resultado = $BD->query($sqlselect); 
        if($resultado){
            if($resultado->num_rows > 0){
                $fila = $resultado->fetch_assoc();
                if($fila['eobjetivo'] != $this->_objetivo || $fila['nivel'] != $this->_nivel || 
                    $fila['dias'] != $this->_dias)
                    $this->crearRutina(true);
            }
            else {
                $this->crearRutina(false); 
            }
        }
        else error_log("Error BD ({$this->conn->errno}): {$this->conn->error}");
        
    }

    private function crearRutina($update){
        $BD = Aplicacion::getInstance()->getConexionBd();
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
        $BD = Aplicacion::getInstance()->getConexionBd();
        if(!$update) {
            $query = "INSERT INTO planificacion (id_usuario, rutina, eobjetivo, dias, nivel) VALUES ('$this->_id', '$guardar', '$this->_objetivo', '$this->_dias', '$this->_nivel')";
        }
        else{
            $query = "UPDATE planificacion SET planificacion.rutina = '$guardar', planificacion.nivel = '$this->_nivel', planificacion.dias = '$this->_dias',  planificacion.eobjetivo = '$this->_objetivo'";
        }
        if ($BD->query($query)) return true;
        else error_log("Error BD ({$conn->errno}): {$conn->error}");
    }


    private function fill_array(&$cont, $nveces , &$arrayaux) {

        $BD = Aplicacion::getInstance()->getConexionBd();
        for ($i = 0; $i < $nveces; $i++){
            $j = 0;
            $musculo = $this->_muscs[$cont];
            $consulta = "SELECT * FROM ejercicios WHERE musculo = '$musculo'"; 
            $resultado = $BD->query($consulta);
            while ($fila = $resultado->fetch_assoc()){
                if($j < $this->_ejerciciosdia){
                    array_push($arrayaux, $fila['nombre']); 
                } 
                $j++;
            }
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