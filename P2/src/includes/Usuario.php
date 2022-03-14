<?php

class Usuario {

    public static function login($nombre, $password) {
        $usuario = self::buscaUsuario($nombre);
        return ($usuario && $usuario->compruebaPassword($password));
    }
    
    public static function crea($apellidos, $correo, $dni, $nombre, $password, $premium) {
        $user = new Usuario($apellidos, $correo, $dni, $nombre, self::hashPassword($password), $premium);
        return $user->inserta($user);
    }

    public static function buscaUsuario($nombreUsuario) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuarios WHERE nombre='%s'", $conn->real_escape_string($nombreUsuario));
        $rs = $conn->query($query);
        if ($rs) {
            $fila = $rs->fetch_assoc();
            $user = new Usuario($fila['apellidos'], $fila['correo'], $fila['dias'], $fila['dni'], $fila['eobjetivo'], $fila['dobjetivo'], $fila['id_usuario'], $fila['nivel'], $fila['nombre'], $fila['password'], $fila['premium']);
            $rs->free();
            return $user;
        } else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }

    public static function buscaPorId($idUsuario) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuario WHERE id=%d", $idUsuario);
        $rs = $conn->query($query);
        if ($rs) {
            $fila = $rs->fetch_assoc();
            $user = new Usuario($fila['apellidos'], $fila['correo'], $fila['dias'], $fila['dni'], $fila['eobjetivo'], $fila['dobjetivo'], $fila['id_usuario'], $fila['nivel'], $fila['nombre'], $fila['password'], $fila['premium']);
            $rs->free();
            return $user;
        } else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }
    
    private static function hashPassword($password) {return password_hash($password, PASSWORD_DEFAULT);}
   
    private static function inserta($usuario) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO usuario (apellidos, correo, dni, nombre, password, premium) VALUES ('%s', '%s', '%s', '%s', '%s', '%d')",
        $conn->real_escape_string($usuario->apellidos), 
        $conn->real_escape_string($usuario->correo), 
        $conn->real_escape_string($usuario->dni), 
        $conn->real_escape_string($usuario->nombre),
        $conn->real_escape_string($usuario->password),
        $conn->real_escape_string($usuario->premium));
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

    private $apellidos;

    private $correo;

    private $dias;

    private $dni;

    private $eobjetivo;

    private $dobjetivo;

    private $id;

    private $nivel;

    private $nombre;

    private $password;

    private $premium;

    private function __construct($apellidos, $correo, $dias = null, $dni, $eobjetivo = null, $dobjetivo = null,  $id = null, $nivel = null, $nombre, $password, $premium = 0) {
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->dias = $dias;
        $this->dni = $dni;
        $this->eobjetivo = $eobjetivo;
        $this->dobjetivo = $dobjetivo;
        $this->id = $id;
        $this->nivel = $nivel;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->premium = $premium;
    }

    public function getApellidos() {return $this->apellidos;}

    public function getCorreo() {return $this->correo;}

    public function getDias() {return $this->dias;}

    public function getDni() {return $this->dni;}

    public function getEobjetivo() {return $this->eobjetivo;}

    public function getDobjetivo() {return $this->dobjetivo;}

    public function getId() {return $this->id;}

    public function getNivel() {return $this->nivel;}

    public function getNombre() {return $this->nombre;}

    public function getPremium() {return $this->premium;}

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
