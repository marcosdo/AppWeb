<?php
namespace es\ucm\fdi\aw;

class Usuario {

    public static function login($alias, $password) {
        $usuario = self::buscaPorAlias($alias);
        return ($usuario && $usuario->compruebaPassword($password)) ? $usuario : false;
    }
    
    public static function crea($nombre, $apellidos, $correo, $password, $alias, $premium) {
        $user = new Usuario($nombre, $apellidos, $correo, self::hashPassword($password), $alias, $premium);
        return $user->inserta($user) ? $user : false;
    }

    public static function buscaPorId($id) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuario WHERE id_usuario = '%d'", $conn->real_escape_string($id));
        $rs = $conn->query($query);
        if ($rs) {
            if($rs->num_rows > 0){
                $fila = $rs->fetch_assoc();
                $user = new Usuario($fila['nombre'], $fila['apellidos'], $fila['correo'], $fila['password'], $fila['usuario'], $fila['premium'], $fila['id_usuario']);
                $rs->free();
                return $user;
            }
        } else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }

    public static function buscaPorAlias($alias) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuario WHERE usuario = '%s'", $alias);
        $rs = $conn->query($query);
        if ($rs) {
            if($rs->num_rows > 0){
                $fila = $rs->fetch_assoc();
                $user = new Usuario($fila['nombre'], $fila['apellidos'], $fila['correo'], $fila['password'], $fila['usuario'], $fila['premium'], $fila['id_usuario']);
                $rs->free();
                return $user;
            }
        } else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }
    
    private static function hashPassword($password) {return password_hash($password, PASSWORD_DEFAULT);}
   
    private static function inserta($usuario) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO usuario (nombre, apellidos, correo, password, usuario, premium) VALUES ('%s', '%s', '%s', '%s', '%s', '%d')",
        $conn->real_escape_string($usuario->nombre),
        $conn->real_escape_string($usuario->apellidos),
        $conn->real_escape_string($usuario->correo), 
        $conn->real_escape_string($usuario->password), 
        $conn->real_escape_string($usuario->alias),
        $usuario->premium);
        if ($conn->query($query)) {
            $usuario->id = $conn->insert_id;
            return true;
        }
        else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }
    
    private static function borra($usuario) {return self::borraPorId($usuario->id);}
    
    private static function borraPorId($idUsuario) {
        if (!$idUsuario) return false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM usuario WHERE id_usuario = %d", $idUsuario);
        if (!$conn->query($query)) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public static function setPremium($id) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("UPDATE usuario SET premium = 1 WHERE id_usuario = '%d'", $conn->real_escape_string($id));
        if ($conn->query($query)) return true;
        else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }

    private $apellidos;

    private $correo;

    private $id;

    private $alias;

    private $nombre;

    private $password;

    private $premium;

    private function __construct($nombre, $apellidos, $correo, $password, $alias, $premium = 0, $id = null) {
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->id = $id;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->premium = $premium;
        $this->alias = $alias;
    }

    public function getApellidos() {return $this->apellidos;}

    public function getCorreo() {return $this->correo;}

    public function getId() {return $this->id;}

    public function getNombre() {return $this->nombre;}

    public function getPremium() {return $this->premium;}

    public function getAlias() {return $this->alias;}

    public function compruebaPassword($password) {return password_verify($password, $this->password);}
    /*
    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
    }*/
    
    public function borrate() {
        if ($this->id !== null) return self::borra($this);
        return false;
    }
}
