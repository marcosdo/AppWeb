<?php
namespace es\ucm\fdi\aw;

class Usuario {
    public const ADMIN_ROLE = 1;
    public const PROFESSIONAL_ROLE = 2;
    public const USER_ROLE = 3;

    // ==================== ATRIBUTOS ====================
    // ====================           ====================
    private $apellidos;
    private $correo;
    private $id;
    private $alias;
    private $nombre;
    private $password;
    private $premium;

    // ==================== MÉTODOS ====================
    // ====================         ====================
    // Constructor
    private function __construct($nombre, $apellidos, $correo, $password, $alias, $premium = 0, $id = null) {
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->id = $id;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->premium = $premium;
        $this->alias = $alias;
    }

    // ==================== PUBLIC ====================
    // Getters y setters
    public function getId() { return $this->id; }
    public function getAlias() { return $this->alias; }
    public function getCorreo() { return $this->correo; }
    public function getNombre() { return $this->nombre; }
    public function getPremium() { return $this->premium; }
    public function getApellidos() { return $this->apellidos; }
    public function setPassword($nuevoPassword) { $this->password = self::hashPassword($nuevoPassword); }

    public static function setPremium($id) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "UPDATE usuario SET premium = 1 WHERE id_usuario = %d"
            , $conn->real_escape_string($id)
        );
        $conn->query($query);
    }

    // Funciones de la clase
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
        $query = sprintf(
            "SELECT * FROM usuario WHERE id_usuario = %d"
            , $id
        );
        try {
            $rs = $conn->query($query);
            $fila = $rs->fetch_assoc();
            if ($fila)
                $result = new Usuario($fila['nombre'], $fila['apellidos'], $fila['correo'], $fila['password'], $fila['usuario'], $fila['premium'], $fila['id_usuario']);
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
            "SELECT * FROM usuario WHERE usuario = '%s'"
            , $alias
        );
        try {
            $rs = $conn->query($query);
            $fila = $rs->fetch_assoc();
            if ($fila)
                $result = new Usuario($fila['nombre'], $fila['apellidos'], $fila['correo'], $fila['password'], $fila['usuario'], $fila['premium'], $fila['id_usuario']);
        } finally {
            if ($rs != null) {
                $rs->free();
            }
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
            "INSERT INTO usuario (nombre, apellidos, correo, password, usuario, premium) VALUES ('%s', '%s', '%s', '%s', '%s', %d)"
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->apellidos)
            , $conn->real_escape_string($usuario->correo)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->alias)
            , $usuario->premium
        );
        try {
            $conn->query($query);
            $usuario->id = $conn->insert_id;
            return $usuario;
        } catch (\mysqli_sql_exception $e) {
            if ($conn->sqlstate == 23000) { // código de violación de restricción de integridad (PK)
                throw new UsuarioYaExisteException("Ya existe el usuario {$usuario->nombreUsuario}");
            }
            throw $e;
        }
    }

    private static function borraPorId($idUsuario) {
        if (!$idUsuario) 
            return false;
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
