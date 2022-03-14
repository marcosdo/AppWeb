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
        <form action ="procesarLogin.php" method = "post">
          <fieldset>
            <legend>Login</legend>
            <div>
              <label for="nombre">Usuario:</label>
              <input id="nombre" type="text" name="nombre"/>
            </div>
            <div>
              <label for="password">Password:</label>
              <input id="password" type="password" name="password"/>
            </div>
            <div>
              <button type="submit" name="login">Entrar</button>
            </div>
          </fieldset>
        </form>
      </main>
      <?php
        require 'includes/vistas/anuncios.php';
        require 'includes/vistas/pie.php';
      ?>
    </div> <!-- Fin del contenedor -->
  </body>
</html>