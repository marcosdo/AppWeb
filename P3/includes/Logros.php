<?php
namespace appweb;

class Logros {
    function __construct() {}

    public static function addLogro($alias,$logroE){
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

    public static function deleteLogro($alias,$logroE){
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
    
    //en un futuro debe estar en usuario
    public static function getId($alias){
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

    public static function getLogros($id_usuario){
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

    public static function getNumLogros($id_usuario){
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

}
