<?php
    session_start();

    $formEnviado = isset($_POST['login']);
    if (!$formEnviado) {
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

    $sql = "SELECT * FROM usuario WHERE Nombre = $username";
	$rs = $conn->query($sql);
	if ($rs) {
		if ($rs->num_rows == 0) {
            //rellenar
        }
        else {
			$fila = $rs->fetch_assoc();
			if (!password_verify($password, $fila[''])) {
                //rellenar
            }
			else $_SESSION["nombre"] = "Usuario";
		}
		$rs->free();
	} else {
		echo "Error SQL ({$conn->errno}):  {$conn->error}";
		exit();
	}

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
                <?php
                    if (!isset($_SESSION["login"])) echo "<h1>ERROR</h1><p>El usuario o contraseña no son válidos.</p>";
                    else echo "<h1>Bienvenido {$_SESSION['nombre']}</h1><p>Usa el menú de la izquierda para navegar.</p>";
                ?>
            </main>
            <?php
                require '/layout/sidebarDer.php';
                require '/layout/pie.php';
            ?>
        </div>
    </body>
</html>