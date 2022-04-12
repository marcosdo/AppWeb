<?php
namespace appweb\foro;

use appweb\Aplicacion;
use DateTime;

class Mensaje {
    // ==================== ATRIBUTOS ====================
    // ====================           ====================
    private $_id_mensaje;
    private $_id_usuario;
    private $_id_referencia;
    private $_id_foro;
    private $_titulo;
    private $_mensaje;
    private $_fecha;
    private $_prioridad;

    // ==================== MÉTODOS ====================
    // ==================== no estaticos ====================
    // Constructor
    public function __construct($id_usuario, $id_foro, $titulo, $mensaje, $prioridad, $id_referencia = 0, $id_mensaje = null) {
        $this->_id_mensaje = $id_mensaje;
        $this->_id_usuario = $id_usuario;
        $this->_id_referencia = $id_referencia;
        $this->_id_foro = $id_foro;
        $this->_titulo = $titulo;
        $this->_mensaje = $mensaje;
        $this->_fecha = date('Y-m-d H:i:s');
        $this->_prioridad = $prioridad;
    }

    // Getters y setters
    public function getID() { return $this->_id_mensaje; }
    public function getTitle() { return $this->_titulo; }
    public function getMessage() { return $this->_mensaje; }

    // ====================  MÉTODOS  ====================
    // ==================== estaticos ====================
    public static function creaMensaje($idusuario, $idforo,  $contenido, $prioridad = 0, $titulo = "Primer mensaje", $idreferencia = null) {
        $msg = new Mensaje($idusuario, $idforo, $titulo, $contenido, $prioridad, $idreferencia);
        return self::inserta($msg);
    }

    public static function inserta($msg) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        if ($msg->_id_referencia != 0) 
            $ref = $msg->_id_referencia;
        else $ref = 'null';
        $query = sprintf(
            "INSERT INTO mensaje (id_usuario, id_referencia, id_foro, titulo, mensaje, fecha, prioridad) 
            VALUES (%d, %s, %d,'%s','%s','%s', %d)"
            , $msg->_id_usuario
            , $ref
            , $msg->_id_foro
            , $conn->real_escape_string($msg->_titulo)
            , $conn->real_escape_string($msg->_mensaje)
            , $conn->real_escape_string($msg->_fecha)
            , $msg->_prioridad
        );
        try {
            $conn->query($query);
            $msg->_id_mensaje = $conn->insert_id;
            return $msg;
        } catch (\mysqli_sql_exception $e) {
            throw $e;
        }
    }

    public static function getMsgs($idforo) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM mensaje WHERE id_foro = %d"
            , $idforo
        );
        try {
            $result = array();
            $rs = $conn->query($query);
            while ($fila = $rs->fetch_assoc())
                array_push($result, $fila);
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return $result;
    }

    public static function buscaPorMensajePadre($idMensajePadre = 0) {
        $result = [];
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM mensaje M WHERE M.id_referencia = %d"
            , $idMensajePadre
        );
        $query .= ' ORDER BY M.fecha DESC';
        $rs = $conn->query($query);
        if ($rs) { 
            while ($fila = $rs->fetch_assoc()) {
                $result[] = new Mensaje($fila['id_usuario'], $fila['id_foro'], $fila['titulo'], $fila['mensaje'], $fila['prioridad'], $fila['id_referencia'], $fila['id_mensaje']);
            }
            $rs->free();
        }
        return $result;
    }

    public static function buscaxID($id) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM mensaje WHERE mensaje.id_mensaje = %d", $id);
        
        try {
            $rs = $conn->query($query); 
            $fila = $rs->fetch_assoc();
            $msg = new Mensaje($fila['id_usuario'], $fila['id_foro'], $fila['titulo'], $fila['mensaje'], $fila['prioridad'], $fila['id_referencia'], $fila['id_mensaje']);
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return $msg;
    }
}