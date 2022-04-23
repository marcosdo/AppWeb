<?php
namespace appweb\productos;

use appweb\Aplicacion;

class Productos {
    // ==================== CONSTANTES ====================
    // ====================           ====================
    

    // ==================== ATRIBUTOS ====================
    // ====================           ====================
  
    // ==================== MÉTODOS ====================
    // ==================== no estaticos ====================
    // Constructor
   
    // Getters y setters
  
    // ====================  MÉTODOS  ====================
    // ==================== estaticos ====================

    /**
     * guardar en una lista todos los productos para usuarios sin plan
     * @return array
     */
    public static function getProductos(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM productos");
        $rs = $conn->query($query);
        
        return $rs; 
    }

    public static function getEmpresas(){
        $empresas = array();
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM empresas");
        $rs = $conn->query($query);
        while($fila = $rs->fetch_assoc()){ 
            array_push($empresas, $fila["nombre"]);
        } 
        return $empresas;    
    }

    public static function getTipos(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SHOW COLUMNS FROM productos WHERE Field = '%s'",
            "tipo"
        );
        $rs = $conn->query($query);
        return $rs;   
    }
    
    public static function getPrecioMaximo(){
        $precio = 0;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM `productos`");
        $rs = $conn->query($query);
        while($fila = $rs->fetch_assoc()){ 
            if($fila["precio"] > $precio) $precio = $fila["precio"];
        } 
        return $precio; 
    }
}