<?php
    session_start();
    unset($_SESSION["login"]);
    unset($_SESSION["nombre"]);
    if(isset($_SESSION["esAdmin"])) unset($_SESSION["esAdmin"]);
    session_destroy();
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
        require 'layout/cabecera.php';
        require 'layout/sidebarIzq.php';
      ?>
      <main>
        <article>
          <h1>Página Logout</h1>
          <p>Gracias por visitar nuestra web. ¡Hasta pronto!</p>
        </article>
      </main>

      <?php
        require 'layout/sidebarDer.php';
        require 'layout/pie.php';
      ?>
    </div> <!-- Fin del contenedor -->
  </body>
</html>