
<aside>
    <div id="actua">
    <?php 
    use appweb\publicidad\ActualizarAnuncio;
    echo ActualizarAnuncio::htmlbanner();
    ?>
    </div>
</aside>

<script src = "//code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
  function actualizar(){$('#actua').load('anuncioAleatorio.php');}
  setInterval("actualizar()",4000);
</script>


