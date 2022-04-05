<?php	
	function mostrarSaludo() {
		$rutaApp = RUTA_APP;
		$html='';
		if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
			return "Bienvenido, {$_SESSION['alias']} <a href='{$rutaApp}/logout.php'>(salir)</a>";
		} else {
			return "Usuario desconocido. <a href='$rutaApp/login.php'>Login.</a>";
		}
		return $html;
	}
?>

<header>
	<h1>Lifety</h1>
	<div class="saludo">
		<?= mostrarSaludo() ?>
	</div>
</header>
