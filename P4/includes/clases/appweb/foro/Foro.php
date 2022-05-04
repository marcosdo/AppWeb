<?php
namespace appweb\foro;

use appweb\Aplicacion;

class Foro {
    // ==================== CONSTANTES ====================
    // ====================           ====================
    public const MAX_SIZE_TITLE = 50;
    public const MAX_SIZE_CONTENT = 500;

    // ==================== ATRIBUTOS ====================
    // ====================           ====================
    private $_id_foro;
    private $_id_usuario;
    private $_fecha;
    private $_tema;
    private $_categoria;
    private $_alias;
    private $_contenido;
    private $_respuestas;

    // ==================== MÉTODOS ====================
    // ==================== no estaticos ====================
    // Constructor
    public function __construct($alias, $idusuario, $fecha, $tema, $contenido, $categoria, $respuestas = 0, $idforo = null) {
        $this->_id_foro = $idforo;
        $this->_fecha = $fecha;
        $this->_tema = $tema;
        $this->_categoria = $categoria;
        $this->_alias = $alias;
        $this->_contenido = $contenido;
        $this->_id_usuario = $idusuario;
        $this->_respuestas = $respuestas;
    }

    public function borrate() {
        if ($this->_id_foro !== null) {
            return self::borra($this);
        }
        return false;
    }

    // Getters y setters
    public function getID() { return $this->_id_foro; }
    public function getIDUsuario() { return $this->_id_usuario; }
    public function getTema() { return $this->_tema; }

    // ====================  MÉTODOS  ====================
    // ==================== estaticos ====================
    public static function crearForo($alias, $idusuario, $fecha, $tema, $contenido, $categoria) {
        $foro = new Foro($alias, $idusuario, $fecha, $tema, $contenido, $categoria);
        return self::inserta($foro);
    }

    public static function inserta($foro) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "INSERT INTO foro (id_usuario, tema, fecha, contenido, categoria, respuestas, nickcreador) 
            VALUES (%d, '%s', '%s', '%s', '%s', %d, '%s')"
            , $foro->_id_usuario
            , $conn->real_escape_string($foro->_tema)
            , $conn->real_escape_string($foro->_fecha)
            , $conn->real_escape_string($foro->_contenido)
            , $conn->real_escape_string($foro->_categoria)
            , $foro->_respuestas
            , $conn->real_escape_string($foro->_alias)
        );
        try {
            $conn->query($query);
            $foro->_id_foro = $conn->insert_id;
            return $foro;
        } catch (\mysqli_sql_exception $e) {
            throw $e;
        }
    }

    public static function buscaxID($idforo) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM foro WHERE foro.id_foro = %d", $idforo);
        
        try {
            $rs = $conn->query($query); 
            $fila = $rs->fetch_assoc();
            if ($fila != null)
                $foro = new Foro($fila['nickcreador'], $fila['id_usuario'], $fila['fecha'], $fila['tema'], $fila['contenido'], $fila['categoria'], $fila['respuestas'], $fila['id_foro']);
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return $foro;
    }

    public static function seleCategorias(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SHOW COLUMNS FROM foro WHERE Field = '%s'",
            "categoria"
        );
        $rs = $conn->query($query);

        $fila = $rs->fetch_assoc();
        $type = $fila['Type'];
        $matches = array();
        $enum = array();
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);

        return $enum;
    }

    private static function borra($foro) {
        return self::borraXID($foro->_id_foro);
    }

    public static function borraXID($idforo) {
        if (!$idforo)
            return false;

        $result = false;

        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM foro WHERE id_foro = %d", $idforo);
        $result = $conn->query($query);
        return $result;
    }

    public static function getData() {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM foro"
        );
        $result = array();
        try {
            $rs = $conn->query($query);
            while ($fila = $rs->fetch_assoc()) {
                array_push($result, $fila);
            }
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return $result;
    }

    /**
     * Funcion que devuelve las filas que son de una determinada categoria
     * @param string $categoria Categoria = { Nutricion, Dieta }
     * @return data Datos consultados en la BD
     */
    public static function getDataxCategoria($categoria) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM foro WHERE categoria = '%s'",
            $categoria
        );
        $result = array();
        try {
            $rs = $conn->query($query);
            while ($fila = $rs->fetch_assoc()) {
                array_push($result, $fila);
            }
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return $result;
    }
}