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
        require 'layout/cabecera.php';
        require 'layout/menu.php';
      ?>
      <main id = "contenido">
        <form action ="procesarLogin.php" method = "post">
          <fieldset>
            <legend>Login</legend>
            <div>
              <label for="username">Usuario:</label>
              <input id="username" type="text" name="username" required/>
            </div>
            <div>
              <label for="password">Password:</label>
              <input id="password" type="password" name="password" required/>
            </div>
            <div>
              <button type="submit" name="login">Entrar</button>
            </div>
          </fieldset>
        </form>
      </main>
      <?php
        require 'layout/anuncios.php';
        require 'layout/pie.php';
      ?>
    </div> <!-- Fin del contenedor -->
  </body>
</html>