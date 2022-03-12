<?php
	session_start();
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
				require('layout/cabecera.php');
				require('layout/menu.php');
			?>
			<main>
				<h1>Registro de usuario</h1>
				<form action="procesarRegistro.php" method="POST">
				<fieldset>
					<legend>Datos para el registro</legend>
            		<div>
                		<label for="nombre">Nombre:</label>
						<input id="nombre" type="text" name="nombre" />
            		</div>
					<div>
                		<label for="apellidos">Apellidos:</label>
						<input id="apellidos" type="text" name="apellidos" />
            		</div>
					<div>
                		<label for="dni">DNI:</label>
						<input id="dni" type="text" name="dni" />
            		</div>
					<div>
                		<label for="mail">Direccion de correo:</label>
						<input id="mail" type="text" name="mail" />
            		</div>
            		<div>
                		<label for="password">Password:</label>
						<input id="password" type="password" name="password" />
            		</div>
            		<div>
                		<label for="password2">Reintroduce la password:</label>
						<input id="password2" type="password" name="password2" />
            		</div>
            		<div>
						<button type="submit" name="registro">Registrar</button>
					</div>
				</fieldset>
				</form>
			</main>
			<?php
				require('layout/anuncios.php');
				require('layout/pie.php');
			?>
		</div>
	</body>
</html>
