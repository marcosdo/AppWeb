<?php
namespace appweb\foro;

use appweb\Aplicacion;
use DateTime;

class Mensaje {
    // ==================== CONSTANTES ====================
    // ====================           ====================
    public const MAX_SIZE = 400;
    public const MAX_SIZE_TITLE = 50;

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
    public function __construct($id_usuario, $id_foro, $titulo, $mensaje, $prioridad, $id_referencia = null, $id_mensaje = null) {
        $this->_id_mensaje = $id_mensaje;
        $this->_id_usuario = $id_usuario;
        $this->_id_referencia = $id_referencia;
        $this->_id_foro = $id_foro;
        $this->_titulo = $titulo;
        $this->_mensaje = $mensaje;
        $this->_fecha = date('Y-m-d H:i:s');
        $this->_prioridad = $prioridad;
    }

    public function borrate() {
        if ($this->_id_mensaje !== null) {
            return self::borra($this);
        }
        return false;
    }

    public function actualizaBD() {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "UPDATE mensaje SET mensaje = '%s' WHERE id_mensaje  = %d"
            , $this->_mensaje
            , $this->_id_mensaje
        );
        $conn->query($query);
    }

    public function getNumRespuestas() {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT COUNT(*) FROM mensaje WHERE id_referencia = %d GROUP BY id_referencia"
            , $this->_id_mensaje
        );
        
        try {
            $result = 0;
            $rs = $conn->query($query);
            if ($fila = $rs->fetch_assoc())
                $result = $fila['COUNT(*)'];
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return $result;
    }

    public function like() {
        $app = Aplicacion::getInstance();
        $conn = $app->getConexionBd();
        $query = sprintf(
            "SELECT * FROM likes WHERE id_usuario = %d AND id_mensaje = %d"
            , $app->idUsuario()
            , $this->_id_mensaje
        );
        $rs = $conn->query($query); 
        if(!$rs->num_rows){
            $query = sprintf(
                "INSERT INTO likes (id_usuario, id_mensaje) VALUES (%d, %d)"
                , $app->idUsuario()
                , $this->_id_mensaje
            );
            try {
                $conn->query($query);
            } catch (\mysqli_sql_exception $e) {
                throw $e;
            }
        }
    }

    public function dislike(){
        $app = Aplicacion::getInstance();
        $conn = $app->getConexionBd();
        $query = sprintf(
            "DELETE FROM likes WHERE id_mensaje = %d AND id_usuario = %d"
            , $this->_id_mensaje
            , $app->idUsuario()
        );
        try {
            $conn->query($query);
        } catch (\mysqli_sql_exception $e) {
            throw $e;
        }
    }

    public function getLikes() {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT COUNT(*) FROM likes WHERE id_mensaje = %d GROUP BY id_mensaje"
            , $this->_id_mensaje
        );
        
        try {
            $result = 0;
            $rs = $conn->query($query);
            if ($fila = $rs->fetch_assoc())
                $result = $fila['COUNT(*)'];
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return $result;
    }

    /**
     * Funcion que devuelve el ID del mensaje raiz
     * @return int ID mensaje
     */
    public function getMsgOrigen() {
        return self::getMsgOrigenRec($this->_id_mensaje);
    }

    /**
     * Funcion que calcula recursivamente quien es el padre original
     * @param int ID del mensaje actuak
     * @return int ID del mensaje padre
     */
    private function getMsgOrigenRec($id) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT id_referencia FROM mensaje WHERE id_mensaje = %d"
            , $id
        );

        try {
            $result = 0;
            $rs = $conn->query($query);
            if ($fila = $rs->fetch_assoc())
                $result = $fila['id_referencia'];
        } finally {
        if ($rs != null)
            $rs->free();
        }

        if ($result == null) {
            return $id;
        }
        return self::getMsgOrigenRec($result);
    }

    // Getters y setters
    public function getID() { return $this->_id_mensaje; }
    public function getIDForo() { return $this->_id_foro; }
    public function getIDUsuario() { return $this->_id_usuario; }
    public function getIDRefencia() { return $this->_id_referencia; }
    public function getTitulo() { return $this->_titulo; }
    public function getFecha() { return $this->_fecha; }
    public function getMensaje() { return $this->_mensaje; }
    public function getPrioridad() { return $this->_prioridad; }
    public function setMensaje($mensaje) { $this->_mensaje = $mensaje; }

    // ====================  MÉTODOS  ====================
    // ==================== estaticos ====================
    public static function creaMensaje($idusuario, $idforo,  $contenido, $prioridad = 0, $titulo = "Contexto", $idreferencia = null) {
        $msg = new Mensaje($idusuario, $idforo, $titulo, $contenido, $prioridad, $idreferencia);
        return self::inserta($msg, $idreferencia);
    }

    public static function inserta($msg, $ref) {
        if ($ref === null)
            $ref = 'null';
        $conn = Aplicacion::getInstance()->getConexionBd();
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

    public static function getMsgs($idforo, $idref = "IS NULL") {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM mensaje WHERE id_foro = %d AND id_referencia "
            , $idforo
        );
        ($idref === "IS NULL") ? $query .= $idref : $query .= ("=" . $idref);
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

    private static function borra($mensaje) {
        return self::borraXID($mensaje->_id_mensaje);
    }

    public static function borraXID($idMensaje) {
        if (!$idMensaje)
            return false;

        $result = false;

        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM mensaje WHERE id_mensaje = %d", $idMensaje);
        $result = $conn->query($query);
        return $result;
    }

    /**
     * Metodo que dado un ID de foro te devuelve el primer mensaje
     * @param int $idforo ID del foro del que se quiere el mensaje
     * @return data
     */
    public static function buscaPrimerMensajexIDForo($idforo) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT id_usuario, id_foro, titulo, mensaje, prioridad, id_referencia, MIN(id_mensaje) AS id_mensaje FROM mensaje WHERE mensaje.id_foro= %d"
            , $idforo
        );
        
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