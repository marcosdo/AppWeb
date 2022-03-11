<?php
	session_start();

	session_start();
    if (!isset($_POST['login'])) {
        header('Location: login.php');
        exit();
    }

	$nombre = htmlspecialchars(trim(strip_tags($_POST["nombre"])));
	$apellidos = htmlspecialchars(trim(strip_tags($_POST["apellidos"])));
	$dni = htmlspecialchars(trim(strip_tags($_POST["dni"])));
	$mail = htmlspecialchars(trim(strip_tags($_POST["mail"])));
    $password = htmlspecialchars(trim(strip_tags($_POST["password"])));
	$password2 = htmlspecialchars(trim(strip_tags($_POST["password2"])));

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
		if ( $rs->num_rows > 0 ) {
			echo 'El usuario ya existe';
			$rs->free();
		} else {
			if($password !== $password2){
				echo 'Las contraseñas no coinciden';
				$rs->free();
			}
			else {
				$sql = "INSERT INTO usuario ( Apellidos, contraseña, correo, dni, Id_usuario, nombre, premium) VALUES('$apellidos', '$password, '$mail', '$dni', '$id', '$nombre', '0')";
				if ( $conn->query($sql) ) {
					$_SESSION["id_usuario"] = $fila["Id_usuario"];
					$_SESSION["nombre"] = $fila["Nombre"];
					$_SESSION["login"] = true; 
					header('Location: index.php');
					exit();
				} else {
					echo "Error SQL ({$conn->errno}):  {$conn->error}";
					exit();
				}
			}
			
		}		
	} else {
		echo "Error SQL ({$conn->errno}):  {$conn->error}";
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Registro</title>
		<link rel="stylesheet" type="text/css" href="estilo.css" />
	</head>
	<body>
		<div id="contenedor">
			<?php
				require('cabecera.php');
				require('sidebarIzq.php');
			?>
			<main>
				
			</main>

			<?php
				require('sidebarDer.php');
				require('pie.php');
			?>
		</div>
	</body>
</html>
