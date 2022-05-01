

<aside>
    Banner de anuncios.
    <div id="actua">
    <?php ?>
    </div>
</aside>

<script src = "//code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
  function actualizar(){$('#actua').load('anuncioAleatorio.php');}
  setInterval("actualizar()",7000);
</script>


