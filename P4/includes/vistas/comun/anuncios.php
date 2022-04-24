<?php
namespace appweb;
use appweb\publicidad\BannerAnuncio; 

function htmlbanner(){
    $array = BannerAnuncio::LogicaBanner();
    $img = RUTA_IMGS;
    $link = $array[1];
    return "<img src='$img/logos/$link'>";
}
?>


<aside>
    Banner de anuncios.
    <div id="actua">
     <?php echo htmlbanner() ?>
    </div>
</aside>

<script type="text/javascript">
  function actualizar(){$('#actua').load('anuncios.php');}
//Función para actualizar cada 4 segundos(4000 milisegundos)
  setInterval("actualizar()",1000);
</script>


