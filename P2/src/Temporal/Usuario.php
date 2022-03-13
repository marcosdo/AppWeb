<?php

class Usuario
{

    public static function login($nombre, $password)
    {
        $usuario = self::buscaUsuario($nombre);
        if ($usuario && $usuario->compruebaPassword($password)) {
            return self::cargaRoles($usuario);
        }
        return false;
    }
    
    public static function crea($nombre, $password)
    {
        $user = new Usuario($nombreUsuario, self::hashPassword($password), $nombre);
        return $user->inserta($user);
    }

    public static function buscaUsuario($nombreUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM Usuarios U WHERE U.nombreUsuario='%s'", $conn->real_escape_string($nombreUsuario));
        $rs = $conn->query($query);
        if ($rs) {
            $fila = $rs->fetch_assoc();
            $user = new Usuario($fila['nombreUsuario'], $fila['password'], $fila['nombre'], $fila['id']);
            $rs->free();

            return $user;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return false;
    }

    public static function buscaPorId($idUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM Usuarios WHERE id=%d", $idUsuario);
        $rs = $conn->query($query);
        if ($rs) {
            $fila = $rs->fetch_assoc();
            $user = new Usuario($fila['nombreUsuario'], $fila['password'], $fila['nombre'], $fila['id']);
            $rs->free();
            return $user;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return false;
    }
    
    private static function hashPassword($password) {return password_hash($password, PASSWORD_DEFAULT);}
   
    private static function inserta($usuario) {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO usuario (nombre, password) VALUES ('%s', '%s')", $conn->real_escape_string($usuario->nombre), $conn->real_escape_string($usuario->password));
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
            $result = self::insertaRoles($usuario);
        } else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return $result;
    }
    
    private static function borra($usuario) {return self::borraPorId($usuario->id);}
    
    private static function borraPorId($idUsuario) {
        if (!$idUsuario) return false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM usuario WHERE Id_usurio = %d", $idUsuario);
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

    private $id;

    private $nivel;

    private $nombre;

    private $password;

    private $premium;

    private function __construct($apellidos, $correo, $dias = null, $dni, $eobjetivo = null,  $id = null, $nivel = null, $nombre, $password, $premium = 0) {
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->dias = $dias;
        $this->dni = $dni;
        $this->eobjetivo = $eobjetivo;
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
