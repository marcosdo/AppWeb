<?php	
	function mostrarSaludo($log){
		if($log) echo"Bienvenido, {$_SESSION['nombre']} <a href='logout.php'>(salir)</a>";
		else echo "Usuario desconocido. <a href='login.php'>Login</a>";
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
				<?php
					mostrarSaludo(isset($_SESSION["login"]));
				?>	
			</div>
		</header>
	</body>
</html>