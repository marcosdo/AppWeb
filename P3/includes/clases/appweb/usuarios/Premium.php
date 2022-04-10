<?php
namespace appweb\usuarios;

use appweb\Aplicacion;

class Premium extends Usuario {

    public static function creaPremium($peso, $altura, $alergias, $observaciones, $num_logros, $logros, $id_usuario, $id_profesional) {
        $premium = new Premium($peso, $altura, $alergias, $observaciones, $num_logros, $logros, $id_usuario, $id_profesional);
        return $premium->inserta($premium);
    }

    public static function buscaID($id_usuario) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM premium WHERE id_usuario = %d"
            , $id_usuario
        );

        $rs = $conn->query($query);
        if ($rs) {
            $fila = $rs->fetch_assoc();
            $premium = new Usuario($fila['peso'], $fila['altura'], $fila['alergias'], $fila['observaciones'], $fila['num_logros'], $fila['logros'], $fila['id_usuario'], $fila['id_profesional']);
            $rs->free();
            return $premium;
        } else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }

    private static function inserta($premium) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "INSERT INTO premium (peso, altura, alergias, observaciones_adicionales, num_logros, logros, id_usuario, id_profesional) VALUES (%d, %d, '%s', '%s', %d, '%s', %d, %d)"
            , $premium->_peso
            , $premium->_altura
            , $conn->real_escape_string($premium->_alergias)
            , $conn->real_escape_string($premium->_observaciones)
            , $premium->_num_logros
            , $conn->real_escape_string($premium->_logros)
            , $premium->_id_usuario
            , $premium->_id_profesional
        );
        try {
            $conn->query($query);
            $premium->_id_usuario = $conn->insert_id;
            return $premium;
        } catch (\mysqli_sql_exception $e) {
            if ($conn->sqlstate == 23000) // código de violación de restricción de integridad (PK)
                throw new UsuarioYaExisteException("Ya existe el usuario {}");
            throw $e;
        }
    }
    
    public static function getNombreEntrenador($id_usuario) { 
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM premium WHERE id_usuario = '%d'", $id_usuario);
        $rs = $conn->query($query); 
        if($rs) {
            $fila = $rs->fetch_assoc();
            $Id_profesional = $fila["id_profesional"];
            $rs->free();
            $query = sprintf("SELECT * FROM profesional WHERE id_profesional = '%d'", $Id_profesional);
            $rs = $conn->query($query); 
            if($rs) {
                $fila = $rs->fetch_assoc();
                $Nombre_profesional = $fila["nutri"];
                $rs->free();
                return $Nombre_profesional;
            }
            else error_log("Error BD ({$conn->errno}): {$conn->error}");

        }
        else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }

    private static function borra($premium) {return self::borraPorId($premium->id);}
    
    private static function borraPorId($id_usuario) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "DELETE FROM premium WHERE id_usuario = %d"
            , $id_usuario
        );
        $conn->query($query);
    }

    private $_peso;
    private $_altura;
    private $_alergias;
    private $_observaciones;
    private $_num_logros;
    private $_logros;
    private $_id_usuario;
    private $_id_profesional;

    private function __construct($peso, $altura, $alergias, $observaciones, $num_logros, $logros, $id_usuario, $id_profesional) {
        $this->_peso = $peso;
        $this->_altura = $altura;
        $this->_alergias = $alergias;
        $this->_observaciones = $observaciones;
        $this->_num_logros = $num_logros;
        $this->_logros = $logros;
        $this->_id_usuario = $id_usuario;
        $this->_id_profesional = $id_profesional;
    }

    public function getPeso() { return $this->_peso; }
    public function getAltura() { return $this->_altura; }
    public function getLogros() { return $this->_logros; }
    public function getAlergias() { return $this->_alergias; }
    public function getNum_logros() { return $this->_num_logros; }
    public function getId_usuario() { return $this->_id_usuario; }
    public function getObservaciones() { return $this->_observaciones; }
    public function getId_profesional() { return $this->_id_profesional; }
 
    public function borrate() {
        if ($this->_id_usuario !== null) return self::borra($this);
        return false;
    }
}
