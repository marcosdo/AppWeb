<?php
    session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="estilo.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Portada</title>
  </head>
  <body>
    <div id="contenedor">
        <?php
          require 'cabecera.php';
          require 'sidebarIzq.php';
        ?>
        <main id = "contenido">
          <?php
            if(isset($_SESSION['esAdmin'])) echo "<h1>Consola de administración.</h1><p>Aquí estarían los controles para la administración de la web.</p>";
            else echo "<h1>Acceso denegado.</h1><p>El usuario no tiene permisos de administrador.</p>";
          ?>
        </main>
        <?php
          require 'sidebarDer.php';
          require 'pie.php';
        ?>
      </div> <!-- Fin del contenedor -->
    </body>
</html>