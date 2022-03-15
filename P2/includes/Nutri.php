<?php
namespace es\ucm\fdi\aw;

class Nutri {

    public static function login($nombre, $password) {
        $nutri = self::buscaNutri($nombre);
        return ($nutri && $nutri->compruebaPassword($password));
    }
    
    public static function crea($nombre, $apellidos, $correo,  $password, $id, $usuarios, $num_usuarios) {
        $nutri = new Nutri($nombre, $apellidos, $correo, self::hashPassword($password), $id, $usuarios, $num_usuarios);
        return $nutri->inserta($nutri);
    }

    public static function buscaNutri($nombre) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM profesional WHERE nombre='%s'", $conn->real_escape_string($nombre));
        $rs = $conn->query($query);
        if ($rs) {
            if($rs->num_rows > 0){
                $fila = $rs->fetch_assoc();
                $user = new Nutri ($fila['nombre'], $fila['apellidos'], $fila['correo'], $fila['password'], $fila['id_profesional'], $fila['usuarios'], $fila['num_usuarios']);
                $rs->free();
                return $user;
            }
            else return false;
            //apellidos, contraseña, correo,  id_profesional, nombre, num_usuarios y usuarios
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
    }

    public static function buscaPorId($id) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM profesional WHERE id_profesional=%d", $id);
        $rs = $conn->query($query);
        if ($rs) {
            if($rs->num_rows > 0) {
                $fila = $rs->fetch_assoc();
                $nutri = new Nutri ($fila['nombre'], $fila['apellidos'], $fila['correo'], $fila['password'], $fila['id_profesional'], $fila['usuarios'], $fila['num_usuarios']);
                $rs->free();
                return $nutri;
            }
            else return false;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
    }
    
    private static function hashPassword($password) {return password_hash($password, PASSWORD_DEFAULT);}
   
    private static function inserta($nutri) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO profesional (nombre, apellidos, correo, password, id_profesional, usuarios, num_usuarios) VALUES ('%s', '%s', '%s', '%s', '%d', '%s', '%s')",
        $conn->real_escape_string($nutri->nombre),
        $conn->real_escape_string($nutri->apellidos), 
        $conn->real_escape_string($nutri->correo),
        $conn->real_escape_string($nutri->password), 
        $conn->real_escape_string($nutri->id), 
        $conn->real_escape_string($nutri->usuarios),
        $conn->real_escape_string($nutri->num_usuarios));
        if ($conn->query($query)) return true;
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

    private $id;

    private $nombre;

    private $num_usuarios;

    private $password;

    private $usuarios;

    private function __construct($nombre, $apellidos, $correo, $id, $password, $usuarios, $num_usuarios) {
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->id = $id;
        $this->nombre = $nombre;
        $this->num_usuarios = $num_usuarios;
        $this->password = $password;
        $this->usuarios = $usuarios;
    }

    public function getApellidos() {return $this->apellidos;}

    public function getCorreo() {return $this->correo;}

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