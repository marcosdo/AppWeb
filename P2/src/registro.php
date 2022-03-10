<?php
//Inicio del procesamiento
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
require('cabecera.php');
require('sidebarIzq.php');
?>
<main>
	<article>
		<h1>Registro de usuario</h1>
		<form action="procesarRegistro.php" method="POST">
		<fieldset>
			<legend>Datos para el registro</legend>
            <div>
                <label for="nombreUsuario">Nombre de usuario:</label>
				<input id="nombreUsuario" type="text" name="nombreUsuario" />
            </div>
            <div>
                <label for="nombre">Nombre:</label>
				<input id="nombre" type="text" name="nombre" />
            </div>
            <div>
                <label for="password">Password:</label>
				<input id="password" type="password" name="password" />
            </div>
            <div>
                <label for="password2">Reintroduce el password:</label>
				<input id="password2" type="password" name="password2" />
            </div>
            <div>
				<button type="submit" name="registro">Registrar</button>
			</div>
		</fieldset>
		</form>
	</article>
</main>
<?php
require('sidebarDer.php');
require('pie.php');
?>
</div>
</body>
</html>
//Inicio del procesamiento
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
require('cabecera.php');
require('sidebarIzq.php');
?>
<main>
	<article>
		<h1>Registro de usuario</h1>
		<form action="procesarRegistro.php" method="POST">
		<fieldset>
			<legend>Datos para el registro</legend>
            <div>
                <label for="nombreUsuario">Nombre de usuario:</label>
				<input id="nombreUsuario" type="text" name="nombreUsuario" />
            </div>
            <div>
                <label for="nombre">Nombre:</label>
				<input id="nombre" type="text" name="nombre" />
            </div>
            <div>
                <label for="password">Password:</label>
				<input id="password" type="password" name="password" />
            </div>
            <div>
                <label for="password2">Reintroduce el password:</label>
				<input id="password2" type="password" name="password2" />
            </div>
            <div>
				<button type="submit" name="registro">Registrar</button>
			</div>
		</fieldset>
		</form>
	</article>
</main>
<?php
require('sidebarDer.php');
require('pie.php');
?>
</div>
</body>
</html>
