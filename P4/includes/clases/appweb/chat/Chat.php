<?php
namespace appweb\chat;

use appweb\Aplicacion;
use appweb\usuarios\Premium;


class Chat {
    function __construct() {}
    
    public static function arrayMensajes($Receptor,$Origen){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM chat WHERE (Origen = '%s' AND Receptor = '%s') OR (Origen = '%s' AND Receptor = '%s') ORDER BY Tiempo ASC",
        $conn->real_escape_string($Receptor),
        $conn->real_escape_string($Origen),
        $conn->real_escape_string($Origen),
        $conn->real_escape_string($Receptor));
        try {
            $Mensajes = array();
            $rs = $conn->query($query);
            while($Mensaje_BD = $rs->fetch_assoc()) {
                $msg = MensajeChat::arrayMsg($Mensaje_BD);
                array_push($Mensajes, $msg);
            }
            $rs->free();
            return $Mensajes;
        } catch (\mysqli_sql_exception $e) {
            throw $e;
        }
    }

    public static function enviarMsgUsu($Mensaje){
        $app = Aplicacion::getInstance();
        $Origen = $app->nombreUsuario();
        $id_usuario = $app->idUsuario();
        $Receptor = Premium::getNombreEntrenador($id_usuario);
        $fecha = date_create()->format('Y-m-d H:i:s');
        MensajeChat::creaMsg($Receptor,$Origen,$fecha,$Mensaje,"U-E");
    }


    public static function enviarMsgEnt($Receptor,$Mensaje){
        $app = Aplicacion::getInstance();
        $Origen = $app->nombreUsuario();
        $fecha = date_create()->format('Y-m-d H:i:s');
        MensajeChat::creaMsg($Receptor,$Origen,$fecha,$Mensaje,"E-U");
    }
}
