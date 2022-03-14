<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/Usuario.php';

$formEnviado = isset($_POST['registro']);
if (! $formEnviado ) {
	header('Location: registro.php');
	exit();
}

require_once __DIR__.'/includes/utils.php';

$erroresFormulario = [];

$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!$nombre || empty($nombre=trim($nombre))) {
	$erroresFormulario['nombre'] = 'El nombre no puede estar vacío.';
}

$apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!$apellidos || empty($apellidos=trim($apellidos))) {
	$erroresFormulario['apellidos'] = 'Los apellidos no pueden estar vacios.';
}

$dni = filter_input(INPUT_POST, 'dni', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ( ! $dni || empty($dni=trim($dni)) || mb_strlen($dni) == 9) {
	$erroresFormulario['dni'] = 'El dni tiene que tener una longitud de 9 caracteres.';
}

$mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ( ! $mail || empty($mail=trim($mail))) {
	$erroresFormulario['mail'] = 'El mail no puede estar vacio.';
}

$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ( ! $password || empty($password=trim($password)) || mb_strlen($password) < 5 ) {
	$erroresFormulario['password'] = 'El password tiene que tener una longitud de al menos 5 caracteres.';
}

$password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ( ! $password2 || empty($password2=trim($password2)) || $password != $password2 ) {
	$erroresFormulario['password2'] = 'Los passwords deben coincidir';
}

if (count($erroresFormulario) === 0) {
	$usuario = Usuario::crea($apellidos, $mail, $dni, $nombre, $password, 0);
	
	if (! $usuario ) {
    	$erroresFormulario[] = "El usuario ya existe";
	} else {
		$_SESSION['login'] = true;
		$_SESSION['nombre'] = $usuario->getNombre();
		$_SESSION['id'] = $usuario->getId();
		header('Location: index.php');
		exit();
	}
}

$tituloPagina = 'Registro';

$erroresGlobalesFormulario = generaErroresGlobalesFormulario($erroresFormulario);
$erroresCampos = generaErroresCampos(['apellidos', 'mail', 'dni', 'nombre', 'password', 'password2'], $erroresFormulario);
$contenidoPrincipal = <<<EOS
<h1>Registro de usuario</h1>
$erroresGlobalesFormulario
<form action="procesarRegistro.php" method="POST">
<fieldset>
	<legend>Datos para el registro</legend>
	<div>
		<label for="nombre">Nombre:</label>
		<input id="nombre" type="text" name="nombre" value="$nombre" />
		{$erroresCampos['nombre']}
	</div>
	<div>
		<label for="apellidos">Apellidos:</label>
		<input id="apellidos" type="text" name="apellidos" value="$apellidos" />
		{$erroresCampos['apellidos']}
	</div>
	<div>
		<label for="dni">DNI:</label>
		<input id="dni" type="text" name="dni" value="$dni" />
		{$erroresCampos['dni']}
	</div>
	<div>
		<label for="mail">>Direccion de correo:</label>
		<input id="mail" type="text" name="mail" value="$mail" />
		{$erroresCampos['mail']}
	</div>
	<div>
		<label for="password">Password:</label>
		<input id="password" type="password" name="password" value="$password" />
		{$erroresCampos['password']}
	</div>
	<div>
		<label for="password2">Reintroduce el password:</label>
		<input id="password2" type="password" name="password2" value="$password2" />
		{$erroresCampos['password2']}
	</div>
	<div>
		<button type="submit" name="registro">Registrar</button>
	</div>
</fieldset>
</form>
EOS;


require __DIR__.'/includes/vistas/plantillas/plantilla.php';
