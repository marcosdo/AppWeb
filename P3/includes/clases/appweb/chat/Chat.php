<?php
namespace appweb\chat;

use appweb\Aplicacion;

class Chat {
    function __construct() {}
    
    public static function dataChat($Receptor,$Origen){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $data = "[" . $Receptor . " 🡺 " . $Origen . "]";
        $query = sprintf("SELECT * FROM chat WHERE (Origen = '%s' AND Receptor = '%s') OR (Origen = '%s' AND Receptor = '%s') ORDER BY Tiempo ASC ",$Receptor,$Origen,$Origen,$Receptor);
        $rs = $conn->query($query);
        if($rs){
            while($chats = $rs->fetch_assoc()){
                if($chats["Tipo"] == "E-U")$data = $data . "\n". "🡸 [" . $chats["Tiempo"] . "] " . $chats["Origen"] . ": " . $chats["Contenido"];
                else $data = $data . "\n". "🡺 [" . $chats["Tiempo"] . "] " . $chats["Origen"] . ": " . $chats["Contenido"];
            }
            $rs->free();
            return $data;
        } else error_log("Error BD ({$conn->errno}): {$conn->error}");
    }

    public static function enviarMsg($Receptor,$Origen,$Mensaje,$tipo){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $fecha = date_create()->format('Y-m-d H:i:s');
        $query = sprintf("INSERT INTO chat (Origen,Receptor,Contenido,Tiempo,Tipo) VALUES ('%s','%s','%s','%s','%s')",$Origen,$Receptor,$Mensaje,$fecha,$tipo); 
        $rs = $conn->query($query);
        if(!$rs) error_log("Error BD ({$conn->errno}): {$conn->error}");
    }
}
