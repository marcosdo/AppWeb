<?php
namespace appweb\foro;

use appweb\Aplicacion;

class Foro {
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

    public function __construct($alias, $idusuario, $fecha, $tema, $contenido, $categoria, $respuestas = 0, $idforo = null) {
        $this->_id_foro = $idforo;
        $this->_fecha = $fecha;
        $this->_tema = $tema;
        $this->_categoria = $categoria;
        $this->_alias = $alias;
        $this->_contenido = $contenido;
        $this->_idusuario = $idusuario;
        $this->_respuestas = $respuestas;
    }

    public function getID() { return $this->_id_foro; }

    public function getData() {
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


    public static function crearForo($alias, $idusuario, $fecha, $tema, $contenido, $categoria) {
        $foro = new Foro($alias, $idusuario, $fecha, $tema, $contenido, $categoria);
        return self::inserta($foro);
    }

    public static function inserta($foro) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "INSERT INTO foro (id_usuario, tema, fecha, contenido, categoria, respuestas, nickcreador) 
            VALUES (%d, '%s', '%s', '%s', '%s', %d, '%s')"
            , $foro->_idusuario
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
}
