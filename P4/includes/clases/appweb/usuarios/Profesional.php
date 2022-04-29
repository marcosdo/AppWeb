<?php
namespace appweb\usuarios;

use appweb\Aplicacion;

class Profesional extends Personas {
    // ==================== MÉTODOS ====================
    // ==================== no estaticos ====================
    // Constructor
    private function __construct($nick, $usuarios, $num_usuarios, $id) {
        $this->_id = $id;
        $this->_nick = $nick;
        $this->_num_usuarios = $num_usuarios;
        $this->_usuarios = $usuarios;
    }

    // Getters y setters
    public function getNick() { return $this->_nick; }
    public function getUsuarios() { return $this->_usuarios; }
    public function getNum_usuarios() { return $this->_num_usuarios; }
    public function setPassword($nuevoPassword) { $this->password = self::hashPassword($nuevoPassword); }

    // Funciones
    public function compruebaPassword($password) { return password_verify($password, $this->password); }
    public function borrate() { return ($this->id !== null) ? self::borra($this) : false; }

    // ==================== ATRIBUTOS ====================
    // ====================           ====================
    protected $_id;
    private $_nick;
    private $_num_usuarios;
    private $_usuarios;

    // ==================== MÉTODOS ====================
    // ==================== estaticos ====================
    public static function crea($person, $nick, $usuarios = "", $num_usuarios = 0) {
        $prof = new Profesional($nick, $usuarios, $num_usuarios, $person->_id);
        return $prof->inserta($person, $prof);
    }

    public static function login($nick, $password) {
        $nutri = self::buscaAlias($nick);
        return ($nutri->compruebaPassword($password)) ? $nutri : false;
    }

    public static function registra($nick, $nombre, $apellidos, $mail, $password) {
        $person = parent::register($nick, $nombre, $apellidos, $mail, $password, Personas::PROFESSIONAL_ROLE);
        return self::crea($person, $nick);
    }


    public static function buscaAlias($nick) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM profesional WHERE nutri='%s'"
            , $nick
        );
        try {
            $rs = $conn->query($query);
            if($rs->num_rows > 0) {
                $fila = $rs->fetch_assoc();
                $nutri = new Profesional ($fila['nutri'], $fila['usuarios'], $fila['num_usuarios'], $fila['id_profesional']);
                
                return $nutri;
            }
        } finally {
            $rs->free();
        }
    }

    public static function buscaID($id) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM profesional WHERE id_profesional=%d", $id);
        $rs = $conn->query($query);
        if ($rs) {
            if($rs->num_rows > 0) {
                $fila = $rs->fetch_assoc();
                $nutri = new Profesional ($fila['nutri'], $fila['usuarios'], $fila['num_usuarios'], $fila['id_profesional']);
                $rs->free();
                return $nutri;
            }
        } else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }
    
    public static function buscaPorMenosUsuarios(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM profesional HAVING MIN(Num_usuarios) > %d"
            , -1
        );
        try {
            $rs = $conn->query($query);
            $fila = $rs->fetch_assoc();
            if ($fila)
                $nutri = new Profesional ($fila['nutri'], $fila['usuarios'], $fila['num_usuarios'], $fila['id_profesional']);
        } finally {
            if ($rs != null)
                $rs->free();
            }
        return $nutri;
    }

    public static function nuevoCliente($usuarios, $num_usuarios, $id, $nickEntrenador) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "UPDATE profesional SET num_usuarios = '%d' WHERE id_profesional = %d"
            , $num_usuarios
            , $id
        );
        $query2 = sprintf(
            "INSERT INTO entrena (nutri, usuario, editarutina, editadieta) VALUES ('%s', '%s', '%d', '%d') "
            , $nickEntrenador
            , $conn->real_escape_string($usuarios)
            , 0
            , 0
        );
        $conn->query($query);
        $conn->query($query2);
    }

    public static function getUsuario($entNombre){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM entrena WHERE nutri = '%s'",$entNombre); 
        $rs = $conn->query($query);
        if($rs){
            $array = array();
            while($fila = $rs->fetch_assoc()) array_push($array,$fila["usuario"]);
            $rs->free();
            return $array;
        } else error_log("Error BD ({$conn->errno}): {$conn->error}");
    }

    public static function getUsuariosRutina ($entNombre){
        $usuarios = array();
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM entrena WHERE nutri = '%s'",$entNombre); 
        $rs = $conn->query($query); 
        while($fila = $rs->fetch_assoc()){
            $queryid = sprintf("SELECT * FROM personas WHERE nick = '%s'",$fila['usuario']);            
            $rsid = $conn->query($queryid);
            $filaid = $rsid->fetch_assoc();
            if($filaid != null){
                $id = $filaid['id_usuario'];
                $query2 = sprintf("SELECT * FROM usuario WHERE id_usuario = '%s'",$id);            
                $rs2 = $conn->query($query2); 
                $filausuario = $rs2->fetch_assoc();
                $query3 = sprintf("SELECT * FROM rutina WHERE id_usuario = '%s'",$filausuario['id_usuario']);          
                $rs3 = $conn->query($query3); 
                $row_cnt = $rs3->num_rows;
                if($row_cnt >0) array_push($usuarios, $fila['usuario']);
            }
        }

       $rs->free();
        
       return $usuarios;
    }


    
    // ==================== PRIVATE ====================
    private static function borra($nutri) { return self::borraPorId($nutri->id); }
    private static function hashPassword($password) {return password_hash($password, PASSWORD_DEFAULT);}

    private static function inserta($person, $prof) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "INSERT INTO profesional (id_profesional, nutri, usuarios, num_usuarios) VALUES (%d, '%s', '%s', %d)"
            , $person->_id
            , $conn->real_escape_string($prof->_nick)
            , $conn->real_escape_string($prof->_usuarios)
            , $prof->_num_usuarios
        );

        try {
            $conn->query($query);
            $prof->id = $conn->insert_id;
            return $prof; 
        } catch (\mysqli_sql_exception $e) {
            if ($conn->sqlstate == 23000) { // código de violación de restricción de integridad (PK)
                throw new UsuarioYaExisteException("Ya existe el nutricionista {$prof->_nick}");
            }
            throw $e;
        }
    }

    private static function borraPorId($id) {
        if (!$id) return false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM profesional WHERE id_profesional = %d", $id);
        if (!$conn->query($query)) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }
}