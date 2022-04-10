<?php
namespace es\ucm\fdi\aw;

class Logros {
    function __construct() {}

    static function addLogro($alias,$logroE){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $idusuE = self::getId($alias);
        $EnumLogros = self::getLogros($idusuE);

        if(!preg_match("/{$logroE}/i",$EnumLogros)){
            $EnumLogros = $EnumLogros . "," . $logroE;
            $num = self::getNumLogros($idusuE);
            $num++;
            $query = sprintf("UPDATE premium SET num_logros = '%d', logros = '%s' WHERE id_usuario = '%s' ",$num,$EnumLogros,$idusuE);
            $rs = $conn->query($query);
            if($rs) return true;
            else error_log("Error BD ({$conn->errno}): {$conn->error}");
        }else return false;
    }

    static function deleteLogro($alias,$logroE){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $idusuE = self::getId($alias);
        $EnumLogros = self::getLogros($idusuE);

        if(preg_match("/{$logroE}/i",$EnumLogros)){
            $EnumLogrosEliminado = str_replace($logroE ,'',$EnumLogros);
            $num = self::getNumLogros($idusuE);
            $num--;
            $query = sprintf("UPDATE premium SET num_logros = '%d', logros = '%s' WHERE id_usuario = '%s' ",$num,$EnumLogrosEliminado,$idusuE);
            $rs = $conn->query($query);
            if($rs) return true;
            else error_log("Error BD ({$conn->errno}): {$conn->error}");
        }else return false;
    }
    
    static function getId($alias){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuario WHERE usuario = '%s'",$alias);
        $rs = $conn->query($query);
        if($rs){
            $fila = $rs->fetch_assoc();
            $rs->free();
            return $fila["id_usuario"];
        }
        else error_log("Error BD ({$conn->errno}): {$conn->error}");
    }

    static function getLogros($id_usuario){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM premium WHERE id_usuario = '%d'",$id_usuario);
        $rs = $conn->query($query);
        if($rs){
            $fila = $rs->fetch_assoc();
            $rs->free();
            return $fila["logros"]; 
        } 
        else error_log("Error BD ({$conn->errno}): {$conn->error}");
    }

    static function getNumLogros($id_usuario){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM premium WHERE id_usuario = '%d'",$id_usuario);
        $rs = $conn->query($query); 
        if($rs){
            $fila = $rs->fetch_assoc();
            $rs->free();
            return $fila["num_logros"];
        }
        else error_log("Error BD ({$conn->errno}): {$conn->error}");
    }

    //esta funcion no debe estar aqui  (NECESITAMOS UNA CLASE DE LOS ENTRENADORES)
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
