<?php
namespace appweb\publicidad;

//use appweb\publicidad\BannerAnuncio; 

class ActualizarAnuncio {
    static function htmlbanner(){
       $array = BannerAnuncio::LogicaBanner();
       $img = RUTA_IMGS;
       $contenido = $array[0];
       $imagen = $array[1];
       $link = $array[2];
       return "<a href='$link' title = '$contenido'>
       <img src='$img/anuncios/$imagen'/></a>";
    }
}