<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="estiloaux.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Portada</title>
  </head>
  <body>
    <div id="contenedor">
      <?php
        require '/layout/cabecera.php';
        require '/layout/sidebarIzq.php';
      ?>
      <main id = "contenido">
        <form action ="procesarLogin.php" method = "post">
          <fieldset>
            <legend>Login</legend>  
            Usuario <br><input type = "text" name = "username" required><br>
            Contraseña <br><input type = "password" name = "password" required><br>
            <input type = "submit" name = "login">
          </fieldset>
        </form>
      </main>
      <?php
        require '/layout/sidebarDer.php';
        require '/layout/pie.php';
      ?>
    </div> <!-- Fin del contenedor -->
  </body>
</html>