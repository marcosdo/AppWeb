<?php
namespace es\ucm\fdi\aw;

class Chat {
    function __construct() {}
    
    static function dataChat($Receptor,$Origen){
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

    static function enviarMsg($Receptor,$Origen,$Mensaje,$tipo){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $fecha = date_create()->format('Y-m-d H:i:s');
        $query = sprintf("INSERT INTO chat (Origen,Receptor,Contenido,Tiempo,Tipo) VALUES ('%s','%s','%s','%s','%s')",$Origen,$Receptor,$Mensaje,$fecha,$tipo); 
        $rs = $conn->query($query);
        if(!$rs) error_log("Error BD ({$conn->errno}): {$conn->error}");
    }
    //esta funcion no debe estar aqui (NECESITAMOS UNA CLASE DE LOS ENTRENADORES)
    static function getUsuario($entNombre){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM entrena WHERE nutri = '%s'",$entNombre); 
        $rs = $conn->query($query);
        if($rs){
            $array = array();
            while($fila = $rs->fetch_assoc()) array_push($array,$fila["usuario"]);
            $rs->free();
            return $array;
        } else error_log("Error BD ({$conn->errno}): {$conn->error}");
    }
}
