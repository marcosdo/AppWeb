<?php
namespace appweb\chat;

use appweb\Aplicacion;
class MensajeChat {
    // ==================== ATRIBUTOS ====================
    // ====================           ====================
    private $_receptor;
    private $_origen;
    private $_fecha;
    private $_contenido;
    private $_tipo;
    private $_id_mensaje_chat;
    // ==================== MÉTODOS ====================
    // Constructor
    public function __construct($receptor, $origen, $fecha, $contenido,$tipo, $id_mensaje_chat = null) {
        $this->_receptor = $receptor;
        $this->_origen = $origen;
        $this->_fecha = $fecha;
        $this->_contenido = $contenido;
        $this->_tipo = $tipo;
        $this->_id_mensaje_chat = $id_mensaje_chat;
    }
   
    public static function arrayMsg($Mensaje_BD){
        $msg = array();
        array_push($msg, $Mensaje_BD["Receptor"]);
        array_push($msg, $Mensaje_BD["Origen"]);
        array_push($msg, $Mensaje_BD["Contenido"]);
        array_push($msg, $Mensaje_BD["Tiempo"]);
        array_push($msg, $Mensaje_BD["Tipo"]);
        return $msg;
    }

    public static function creaMsg($receptor, $origen, $fecha, $contenido,$tipo) {
        $msg = new MensajeChat($receptor, $origen, $fecha, $contenido, $tipo);
        return self::inserta($msg);
    }

    public static function inserta($msg) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("INSERT INTO chat (Origen,Receptor,Contenido,Tiempo,Tipo) 
        VALUES ('%s','%s','%s','%s','%s')",
        $conn->real_escape_string($msg->_origen),
        $conn->real_escape_string($msg->_receptor),
        $conn->real_escape_string($msg->_contenido),
        $conn->real_escape_string($msg->_fecha),
        $conn->real_escape_string($msg->_tipo));
        try {
            $conn->query($query);
            $msg->_id_mensaje_chat = $conn->insert_id;
            return $msg;
        } catch (\mysqli_sql_exception $e) {
            throw $e;
        }
    }
}