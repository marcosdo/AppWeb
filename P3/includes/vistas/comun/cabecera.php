<?php	
	function mostrarSaludo() {
		$rutaApp = RUTA_APP;
		$html='';
		if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
			return "Bienvenido, {$_SESSION['alias']} <a href='{$rutaApp}/logout.php'>(salir)</a>";
		} else {
			return "Usuario desconocido. <a href='{$rutaApp}/login.php'>Login</a> <a href='{$rutaApp}/registro.php'>Registro</a>";
		}
		return $html;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
		<header>
			<h1>Bienvenido a Lifety</h1>
			<div class="saludo">
				<?= mostrarSaludo() ?>
			</div>
		</header>
	</body>
</html>