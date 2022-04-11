<?php
namespace appweb\usuarios;

use appweb\Aplicacion;

class Personas {
    public const ADMIN_ROLE = 0;
    public const USER_ROLE = 1;
    public const PROFESSIONAL_ROLE = 2;

    // ==================== ATRIBUTOS ====================
    // ====================           ====================
    protected $_id;
    protected $_alias;
    protected $_nombre;
    protected $_apellidos;
    protected $_correo;
    protected $_password;
    protected $_rol;

    // ==================== MÉTODOS ====================
    // ====================         ====================
    // Constructor
    private function __construct($alias, $nombre, $apellidos, $correo, $password, $rol = Personas::USER_ROLE, $id = null) {
        $this->_id = $id;
        $this->_alias = $alias;
        $this->_nombre = $nombre;
        $this->_apellidos = $apellidos;
        $this->_correo = $correo;
        $this->_password = $password;
        $this->_rol = $rol;
    }

    // ==================== PUBLIC ====================
    // Getters y setters
    public function getId() { return $this->_id; }
    public function getRol() { return $this->_rol; }
    public function getAlias() { return $this->_alias; }
    public function getCorreo() { return $this->_correo; }
    public function getNombre() { return $this->_nombre; }
    public function getApellidos() { return $this->_apellidos; }
    public function setPassword($nuevoPassword) { $this->_password = self::hashPassword($nuevoPassword); }

    // Funciones de la clase
    public static function login($alias, $password) {
        $usuario = self::buscaPorAlias($alias);
        if($usuario != null){
            if ($usuario->compruebaPassword($password))
                return $usuario;
            throw new \Exception("Contraseña incorrecta");
        }
    }

    public static function register($alias, $nombre, $apellidos, $correo, $password, $rol = Personas::USER_ROLE) {
        $user = new Personas($alias, $nombre, $apellidos, $correo, self::hashPassword($password), $rol);
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
                $result = new Personas($fila['nick'], $fila['nombre'], $fila['apellidos'], $fila['correo'], $fila['contraseña'], $fila['rol'], $fila['id_usuario']);
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
                $result = new Personas($fila['nick'], $fila['nombre'], $fila['apellidos'], $fila['correo'], $fila['contraseña'], $fila['rol'], $fila['id_usuario']);
            else
                $result = null;
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
            "INSERT INTO personas (nick, nombre, apellidos, correo, contraseña, rol) VALUES ('%s', '%s', '%s', '%s', '%s', %d)"
            , $conn->real_escape_string($usuario->_alias)
            , $conn->real_escape_string($usuario->_nombre)
            , $conn->real_escape_string($usuario->_apellidos)
            , $conn->real_escape_string($usuario->_correo)
            , $conn->real_escape_string($usuario->_password)
            , $usuario->_rol
        );
        try {
            $conn->query($query);
            $usuario->_id = $conn->insert_id;
            return $usuario;
        } catch (\mysqli_sql_exception $e) {
            if ($conn->sqlstate == 23000) { // código de violación de restricción de integridad (PK)
                throw new UsuarioYaExisteException("Ya existe el usuario {$usuario->_alias}");
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

    protected function compruebaPassword($password) {
        return password_verify($password, $this->_password);
    }

    private static function hashPassword($password) { 
        return password_hash($password, PASSWORD_DEFAULT);
    }
}