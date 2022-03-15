<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Registro';

$contenidoPrincipal = <<<EOS
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
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';