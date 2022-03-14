<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/Usuario.php';

$formEnviado = isset($_POST['login']);
if (! $formEnviado ) {
	header('Location: login.php');
	exit();
}

require_once __DIR__.'/includes/utils.php';

$erroresFormulario = [];

$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!$nombre || empty($nombre=trim($nombre))) {
	$erroresFormulario['nombre'] = 'El nombre de usuario no puede estar vacío.';
}

$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!$password || empty($password=trim($password))) {
	$erroresFormulario['password'] = 'El password no puede estar vacío.';
}
        
if (count($erroresFormulario) === 0) {
	$usuario = Usuario::login($nombre, $password);
	$nutri = Nutri::login($nombre, $password);
	if (!$usuario && !$nutri) {
		$erroresFormulario[] = "El nombre o el password no coinciden";
	} 
	else if($usuario) {
		$_SESSION['login'] = true;
		$_SESSION['nombre'] = $usuario->getNombre();
		$_SESSION['id'] = $usuario->getId();
		header('Location: index.php');
		exit();
	}
	else{
		$_SESSION['login'] = true;
		$_SESSION['nombre'] = $nutri->getNombre();
		$_SESSION['id'] = $nutri->getId();
		$_SESSION['nutri'] = true;
		header('Location: index.php');
		exit();
	}
}

$tituloPagina = 'Login';

$erroresGlobalesFormulario = generaErroresGlobalesFormulario($erroresFormulario);
$erroresCampos = generaErroresCampos(['nombre', 'password'], $erroresFormulario);
$contenidoPrincipal= <<<EOS
<h1>Acceso al sistema</h1>
$erroresGlobalesFormulario
<form action="procesarLogin.php" method="POST">
	<fieldset>
		<legend>Usuario y contraseña</legend>
		<div>
			<label for="nombre">Usuario:</label>
			<input id="nombre" type="text" name="nombre" value="$nombre" />
			{$erroresCampos['nombre']}
		</div>
		<div>
			<label for="password">Password:</label>
			<input id="password" type="password" name="password" value="$password" />
			{$erroresCampos['password']}
		</div>
		<div>
			<button type="submit" name="login">Entrar</button>
		</div>
	</fieldset>
</form>
EOS;


require __DIR__.'/includes/vistas/plantillas/plantilla.php';
