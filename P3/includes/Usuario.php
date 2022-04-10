<?php
namespace es\ucm\fdi\aw;

class Usuario extends Personas {
    // ==================== MÉTODOS ====================
    // ==================== no estaticos ====================
    // Constructor
    private function __construct($premium) {
        $this->_premium = $premium;
    }

    // Getters y setters
    public function getPremium() { return $this->_premium; }

    // Funciones
    public function borrate() { return ($this->id !== null) ? self::borra($this) : false; }

    // ==================== ATRIBUTOS ====================
    // ====================           ====================
    private $_premium;

    // ==================== MÉTODOS ====================
    // ==================== estaticos ====================
    public static function crea($person, $premium = 0) {
        $user = new Usuario($premium);
        return $user->inserta($person, $user);
    }

    public static function login($alias, $password) {
        $usuario = self::buscaPorAlias($alias);
        return ($usuario && $usuario->compruebaPassword($password)) ? $usuario : false;
    }

    public static function registra($nick, $nombre, $apellidos, $mail, $password, $rol = Personas::USER_ROLE) {
        $person = parent::register($nick, $nombre, $apellidos, $mail, $password, $rol);
        return self::crea($person);
    }

    public static function buscaID($id) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM usuario WHERE id_usuario = %d"
            , $id
        );
        try {
            $rs = $conn->query($query);
            $fila = $rs->fetch_assoc();
            if ($fila)
                $result = new Usuario($fila['id_usuario'], $fila['premium']);
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return $result;
    }

    public static function setPremium($id) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "UPDATE usuario SET premium = 1 WHERE id_usuario = %d"
            , $id
        );
        $conn->query($query);
    }

    // ==================== PRIVATE ====================
    private static function inserta($person, $usuario) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "INSERT INTO usuario (id_usuario, premium) VALUES (%d, %d)"
            , $person->_id
            , $usuario->_premium
        );
        try {
            $conn->query($query);
            $usuario->id = $conn->insert_id;
            return $usuario;
        } catch (\mysqli_sql_exception $e) {
            if ($conn->sqlstate == 23000) // código de violación de restricción de integridad (PK)
                throw new UsuarioYaExisteException("Ya existe el usuario {}");
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

    private static function borra($usuario) { return self::borraPorId($usuario->id); }
}
