<?php
namespace es\ucm\fdi\aw;

class Nutri {

    public static function login($alias, $password) {
        $nutri = self::buscaNutri($alias);
        return ($nutri && $nutri->compruebaPassword($password)) ? $nutri : false;
    }
    
    public static function crea($nombre, $apellidos, $correo,  $password, $alias, $usuarios, $num_usuarios) {
        $nutri = new Nutri($nombre, $apellidos, $correo, self::hashPassword($password), $alias, $usuarios, $num_usuarios);
        return $nutri->inserta($nutri) ? $nutri : false;
    }

    public static function buscaNutri($alias) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM profesional WHERE nutri='%s'", $conn->real_escape_string($alias));
        $rs = $conn->query($query);
        if ($rs) {
            if($rs->num_rows > 0){
                $fila = $rs->fetch_assoc();
                $nutri = new Nutri ($fila['nombre'], $fila['apellidos'], $fila['correo'], $fila['password'], $fila['nutri'], $fila['usuarios'], $fila['num_usuarios'], $fila['id_profesional']);
                $rs->free();
                return $nutri;
            }
        } else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }

    public static function buscaPorId($id) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM profesional WHERE id_profesional=%d", $id);
        $rs = $conn->query($query);
        if ($rs) {
            if($rs->num_rows > 0) {
                $fila = $rs->fetch_assoc();
                $nutri = new Nutri ($fila['nombre'], $fila['apellidos'], $fila['correo'], $fila['password'], $fila['nutri'], $fila['usuarios'], $fila['num_usuarios'], $fila['id_profesional']);
                $rs->free();
                return $nutri;
            }
        } else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }
    
    private static function hashPassword($password) {return password_hash($password, PASSWORD_DEFAULT);}
   
    private static function inserta($nutri) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO profesional (nombre, apellidos, correo, password, nutri, usuarios, num_usuarios) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%d')",
        $conn->real_escape_string($nutri->nombre),
        $conn->real_escape_string($nutri->apellidos), 
        $conn->real_escape_string($nutri->correo),
        $conn->real_escape_string($nutri->password), 
        $conn->real_escape_string($nutri->alias), 
        $conn->real_escape_string($nutri->usuarios),
        $nutri->num_usuarios);
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

    public static function buscaPorMenosUsuarios(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM profesional HAVING MIN(Num_usuarios) > %d", -1);
        $rs = $conn->query($query);
        if ($rs) {
            $fila = $rs->fetch_assoc();
            $nutri = new Nutri ($fila['nombre'], $fila['apellidos'], $fila['correo'], $fila['password'], $fila['nutri'], $fila['usuarios'], $fila['num_usuarios'], $fila['id_profesional']);
            $rs->free();
            return $nutri;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
    }
    
    public static function nuevoCliente($usuarios, $num_usuarios, $id) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query =  sprintf("UPDATE profesional SET usuarios = '%s' , num_usuarios = '%d' WHERE id_profesional = '%d'", 
        $conn->real_escape_string($usuarios), 
        $num_usuarios, 
        $id);
        if ($conn->query($query)) return true;
        else error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }

    private $apellidos;

    private $correo;

    private $id;

    private $alias;

    private $nombre;

    private $num_usuarios;

    private $password;

    private $usuarios;

    private function __construct($nombre, $apellidos, $correo, $password, $alias, $usuarios, $num_usuarios, $id = null) {
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->id = $id;
        $this->nombre = $nombre;
        $this->num_usuarios = $num_usuarios;
        $this->password = $password;
        $this->usuarios = $usuarios;
        $this->alias = $alias;
    }

    public function getApellidos() {return $this->apellidos;}

    public function getCorreo() {return $this->correo;}

    public function getId() {return $this->id;}

    public function getNum_usuarios() {return $this->num_usuarios;}

    public function getNombre() {return $this->nombre;}

    public function getUsuarios() {return $this->usuarios;}

    public function getAlias() {return $this->alias = $alias;}

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
