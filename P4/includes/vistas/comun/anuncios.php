<?php
namespace appweb;
use appweb\publicidad\BannerAnuncio; 

function htmlbanner(){
    $array = BannerAnuncio::LogicaBanner();
    $img = RUTA_IMGS;
    $contenido = $array[0];
    $imagen = $array[1];
    $link = $array[2];
    return "<a href='$link' title = '$contenido'>
    <img src='$img/anuncios/$imagen'/></a>";
}
?>


<aside>
    Banner de anuncios.
    <div id="actua">
     <?php echo htmlbanner() ?>
    </div>
</aside>



