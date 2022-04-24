<?php

namespace appweb\publicidad;

use appweb\Aplicacion;

class BannerAnuncio {
   
    private function __construct() {}

    static public function LogicaBanner(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM anuncio ORDER BY RAND() LIMIT 1");
        $rs = $conn->query($query);
        $fila = $rs->fetch_assoc();
        $array = array();
        array_push($array, $fila["contenido"],$fila["imagen"],$fila["link"]);
        return $array;
    }

}