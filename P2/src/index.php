<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../Resources/CSS/estiloaux.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Portada</title>
  </head>
  <body>
    <div id="contenedor">
      <?php
        require 'includes/vistas/cabecera.php';
        require 'includes/vistas/menu.php';
      ?>
      <main id = "contenido">
          <h1> Bienvenido a nuestra web </h1>
      </main>
      <?php
        require 'includes/vistas/anuncios.php';
        require 'includes/vistas/pie.php';
      ?>
    </div> <!-- Fin del contenedor -->
  </body>
</html>