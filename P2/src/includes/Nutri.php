<?php

class Nutri {

    public static function login($nombre, $password) {
        $nutri = self::buscaNutri($nombre);
        return ($nutri && $nutri->compruebaPassword($password));
    }
    
    public static function crea($apellidos, $correo, $dni, $nombre, $num_usuarios, $password, $usuarios) {
        $nutri = new Nutri($apellidos, $correo, $dni, $nombre, $num_usuarios, self::hashPassword($password), $usuarios);
        return $nutri->inserta($nutri);
    }

    public static function buscaNutri($nombre) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM profesional WHERE nombre='%s'", $conn->real_escape_string($nombre));
        $rs = $conn->query($query);
        if ($rs) {
            $fila = $rs->fetch_assoc();
            $user = new Nutri ($fila['apellidos'], $fila['correo'], $fila['dias'], $fila['dni'], $fila['eobjetivo'], $fila['id_usuario'], $fila['nivel'], $fila['nombre'], $fila['password'], $fila['premium']);
            $rs->free();
            return $user;
        } else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }

    public static function buscaPorId($id)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuario WHERE id=%d", $id);
        $rs = $conn->query($query);
        if ($rs) {
            $fila = $rs->fetch_assoc();
            $nutri = new Usuario($fila['apellidos'], $fila['correo'], $fila['dni'], $fila['id_profesional'], $fila['nombre'], $fila['num_usuarios'], $fila['password'], $fila['usuarios']);
            $rs->free();
            return $nutri;
        } else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }
    
    private static function hashPassword($password) {return password_hash($password, PASSWORD_DEFAULT);}
   
    private static function inserta($nutri) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO profesional (apellidos, correo, dni, nombre, num_usuarios, password, usuarios) VALUES ('%s', '%s', '%s', '%s', '%d', '%s', '%s')",
        $conn->real_escape_string($nutri->apellidos), 
        $conn->real_escape_string($nutri->correo), 
        $conn->real_escape_string($nutri->dni), 
        $conn->real_escape_string($nutri->nombre),
        $conn->real_escape_string($nutri->num_usuarios),
        $conn->real_escape_string($nutri->password),
        $conn->real_escape_string($nutri->premium),
        $conn->real_escape_string($nutri->usuarios));
        if ($conn->query($query)) {
            $nutri->id = $conn->insert_id;
            return true;
        }
        else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }
    
    private static function borra($nutri) {return self::borraPorId($nutri->id);}
    
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

    private $apellidos;

    private $correo;

    private $dni;

    private $id;

    private $nombre;

    private $num_usuarios;

    private $password;

    private $usuarios;

    private function __construct($apellidos, $correo, $dni,  $id = null, $nombre, $num_usuarios = 0, $password, $usuarios = "") {
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->dni = $dni;
        $this->id = $id;
        $this->nombre = $nombre;
        $this->num_usuarios = $num_usuarios;
        $this->password = $password;
        $this->usuarios = $usuarios;
    }

    public function getApellidos() {return $this->apellidos;}

    public function getCorreo() {return $this->correo;}

    public function getDni() {return $this->dni;}

    public function getId() {return $this->id;}

    public function getNum_usuarios() {return $this->num_usuarios;}

    public function getNombre() {return $this->nombre;}

    public function getUsuarios() {return $this->usuarios;}

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
