<?php
namespace es\ucm\fdi\aw;

class Premium {

    public static function crea($peso, $altura, $alergias, $observaciones, $num_logros, $logros, $id_usuario, $id_profesional) {
        $premium = new Premium($peso, $altura, $alergias, $observaciones, $num_logros, $logros, $id_usuario, $id_profesional);
        return $premium->inserta($premium) ? $premium : false;
    }

    public static function buscaPorId($id_usuario) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM premium WHERE id_usuario=%d", $id_usuario);
        $rs = $conn->query($query);
        if ($rs) {
            $fila = $rs->fetch_assoc();
            $premium = new Usuario($fila['peso'], $fila['altura'], $fila['alergias'], $fila['observaciones'], $fila['num_logros'], $fila['logros'], $fila['id_usuario'], $fila['id_profesional']);
            $rs->free();
            return $premium;
        } else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }
    
    private static function hashPassword($password) {return password_hash($password, PASSWORD_DEFAULT);}
   
    private static function inserta($premium) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query= "INSERT INTO premium (peso, altura, alergias, observaciones_adicionales, num_logros, logros, id_usuario, id_profesional) VALUES ('$premium->peso', '$premium->altura', '$premium->alergias', '$premium->observaciones', '$premium->num_logros', '$premium->logros', '$premium->id_usuario', '$premium->id_profesional')";
        if ($conn->query($query)) return true;
        else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }
    
    private static function borra($premium) {return self::borraPorId($premium->id);}
    
    private static function borraPorId($id_usuario) {
        if (!$id_usuario) return false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM premium WHERE id_usuario = %d", $id_usuario);
        if (!$conn->query($query)) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    private $peso;

    private $altura;

    private $alergias;

    private $observaciones;

    private $num_logros;

    private $logros;

    private $id_usuario;

    private $id_profesional;

    private function __construct($peso, $altura, $alergias, $observaciones, $num_logros, $logros, $id_usuario, $id_profesional) {
        $this->peso = $peso;
        $this->altura = $altura;
        $this->alergias = $alergias;
        $this->observaciones = $observaciones;
        $this->num_logros = $num_logros;
        $this->logros = $logros;
        $this->id_usuario = $id_usuario;
        $this->id_profesional = $id_profesional;
    }

    public function getPeso() {return $this->peso;}

    public function getAltura() {return $this->altura;}

    public function getAlergias() {return $this->alergias;}

    public function getObservaciones() {return $this->observaciones;}

    public function getNum_logros() {return $this->num_logros;}

    public function getLogros() {return $this->logros;}

    public function getId_usuario() {return $this->id_usuario;}

    public function getId_profesional() {return $this->id_profesional;}
 
    public function borrate() {
        if ($this->id !== null) return self::borra($this);
        return false;
    }
}
