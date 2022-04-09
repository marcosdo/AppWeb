<?php
namespace es\ucm\fdi\aw;

use Exception;

class Usuarios {
    public const ADMIN_ROLE = 0;
    public const USER_ROLE = 1;
    public const PROFESSIONAL_ROLE = 2;

    // ==================== ATRIBUTOS ====================
    // ====================           ====================
    private $id;
    private $alias;
    private $nombre;
    private $apellidos;
    private $correo;
    private $password;
    private $rol;

    // ==================== MÉTODOS ====================
    // ====================         ====================
    // Constructor
    private function __construct($alias, $nombre, $apellidos, $correo, $password, $rol = Usuarios::USER_ROLE, $id = null) {
        $this->id = $id;
        $this->alias = $alias;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->password = $password;
        $this->rol = $rol;
    }

    // ==================== PUBLIC ====================
    // Getters y setters
    public function getId() { return $this->id; }
    public function getRol() { return $this->rol; }
    public function getAlias() { return $this->alias; }
    public function getCorreo() { return $this->correo; }
    public function getNombre() { return $this->nombre; }
    public function getApellidos() { return $this->apellidos; }
    public function setPassword($nuevoPassword) { $this->password = self::hashPassword($nuevoPassword); }

    // Funciones de la clase
    public static function login($alias, $password) {
        $usuario = self::buscaPorAlias($alias);
        if ($usuario->compruebaPassword($password))
            return $usuario;
        throw new Exception("Contraseña incorrecta");
    }

    public static function register($alias, $nombre, $apellidos, $correo, $password) {
        $user = new Usuarios($alias, $nombre, $apellidos, $correo, self::hashPassword($password));
        return $user->inserta($user);
    }

    public static function buscaPorId($id) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM usuario WHERE id_usuario = %d"
            , $id
        );
        try {
            $rs = $conn->query($query);
            $fila = $rs->fetch_assoc();
            if ($fila)
                $result = new Usuarios($fila['nick'], $fila['nombre'], $fila['apellidos'], $fila['correo'], $fila['contraseña'], $fila['rol'], $fila['id_usuario']);
        } finally {
            if ($rs != null) {
                $rs->free();
            }
        }
        return $result;
    }

    public static function buscaPorAlias($alias) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM personas WHERE nick = '%s'"
            , $alias
        );
        try {
            $rs = $conn->query($query);
            $fila = $rs->fetch_assoc();
            if ($fila)
                $result = new Usuarios($fila['nick'], $fila['nombre'], $fila['apellidos'], $fila['correo'], $fila['contraseña'], $fila['rol'], $fila['id_usuario']);
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return $result;
    }

    public function borrate() {
        if ($this->id !== null) 
            return self::borra($this);
        return false;
    }

    // ==================== PRIVATE ====================
    private static function inserta($usuario) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "INSERT INTO personas (nick, nombre, apellidos, correo, contraseña) VALUES ('%s', '%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($usuario->alias)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->apellidos)
            , $conn->real_escape_string($usuario->correo)
            , $conn->real_escape_string($usuario->password)
        );
        try {
            $conn->query($query);
            $usuario->id = $conn->insert_id;
            return $usuario;
        } catch (\mysqli_sql_exception $e) {
            if ($conn->sqlstate == 23000) { // código de violación de restricción de integridad (PK)
                throw new UsuarioYaExisteException("Ya existe el usuario {$usuario->alias}");
            }
            throw $e;
        }
    }

    private static function borraPorId($idUsuario) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "DELETE FROM usuario WHERE id_usuario = %d"
            , $idUsuario
        );
        $conn->query($query);
    }

    private static function borra($usuario) { 
        return self::borraPorId($usuario->id); 
    }

    private function compruebaPassword($password) {
        return password_verify($password, $this->password);
    }

    private static function hashPassword($password) { 
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
