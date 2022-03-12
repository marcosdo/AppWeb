<?php
    session_start();
    $formEnviado = isset($_POST['login']);
    if (! $formEnviado ) {
        header('Location: login.php');
        exit();
    }

    $username = htmlspecialchars(trim(strip_tags($_POST["username"])));
    $password = htmlspecialchars(trim(strip_tags($_POST["password"])));

    $conn = new mysqli('localhost', 'root', '', 'lifety');
	if ( $conn->connect_errno ) {
		echo "Error de conexión a la BD ({$conn->connect_errno}):  {$conn->connect_error}";
		exit();
	}
	if ( ! $conn->set_charset("utf8mb4")) {
		echo "Error al configurar la BD ({$conn->errno}):  {$conn->error}";
		exit();
	}

    $sql = "SELECT * FROM usuario WHERE Nombre = '$username'";
	$rs = $conn->query($sql);
	if ($rs) {
		if ($rs->num_rows != 0){
			$fila = $rs->fetch_assoc();
			if ($password === $fila['Password']) {
                $_SESSION["id_usuario"] = $fila["Id_usuario"];
                $_SESSION["nombre"] = $username;
                $_SESSION["login"] = true; 
            }
            else $_SESSION["login"] = false;

		}
		$rs->free();
	} else {
		echo "Error SQL ({$conn->errno}):  {$conn->error}";
	}
    $conn->close();
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
                <?php
                    if (!isset($_SESSION["login"])) echo "<h1>ERROR</h1><p>El usuario o contraseña no son válidos.</p>";
                ?>
            </main>
            <?php
                require 'includes/vistas/anuncios.php';
                require 'includes/vistas/pie.php';
            ?>
        </div>
    </body>
</html>