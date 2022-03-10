<?php
//Inicio del procesamiento
session_start();

$formEnviado = isset($_POST['registro']);
if (! $formEnviado ) {
	header('Location: registro.php');
	exit();
}

require_once __DIR__.'/utils.php';

$erroresFormulario = [];


$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ( ! $nombre || empty($nombre=trim($nombre)) || mb_strlen($nombre) < 5) {
	$erroresFormulario['nombre'] = 'El nombre tiene que tener una longitud de al menos 5 caracteres.';
}

$apellido1 = filter_input(INPUT_POST, 'apellido1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ( ! $apellido1 || empty($apellido1=trim($apellido1)) || mb_strlen($apellido1) < 3) {
	$erroresFormulario['apellido1'] = 'El apellido tiene que tener una longitud de al menos 3 caracteres.';
}

$apellido2 = filter_input(INPUT_POST, 'apellido2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ( ! $apellido2 || empty($apellido2=trim($apellido2)) || mb_strlen($apellido2) < 3) {
	$erroresFormulario['apellido2'] = 'El apellido tiene que tener una longitud de al menos 3 caracteres.';
}

$dni = filter_input(INPUT_POST, 'dni', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ( ! $dni || empty($dni=trim($dni)) || mb_strlen($dni) < 9) {
	$erroresFormulario['dni'] = 'El DNI tiene que tener una longitud de 9 caracteres.';
}

$correo_electronico = filter_input(INPUT_POST, 'correo_electronico', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ( ! $correo_electronico || empty($correo_electronico=trim($correo_electronico)) || mb_strlen($correo_electronico) < 14) {
	$erroresFormulario['correo_electronico'] = 'El correo electrónico tiene que tener una longitud de al menos 14 caracteres.';
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
	$conn = conexionBD();
	
	$query=sprintf("SELECT * FROM Usuarios U WHERE U.nombreUsuario = '%s'", $conn->real_escape_string($nombreUsuario));
	$rs = $conn->query($query);
	if ($rs) {
		if ( $rs->num_rows > 0 ) {
			$erroresFormulario[] = 'El usuario ya existe';
			$rs->free();
		} else {
			$query=sprintf("INSERT INTO Usuarios(nombreUsuario, nombre, password) VALUES('%s', '%s', '%s')"
					, $conn->real_escape_string($nombreUsuario)
					, $conn->real_escape_string($nombre)
					, password_hash($password, PASSWORD_DEFAULT)
			);
			if ( $conn->query($query) ) {
				$idUsuario = $conn->insert_id;
				$query=sprintf("INSERT INTO RolesUsuario(rol, usuario) VALUES(%d, %d)"
					, USER_ROLE
					, $idUsuario
				);
				if ( $conn->query($query) ) {
					$_SESSION['login'] = true;
					$_SESSION['nombre'] = $nombre;
					$_SESSION['esAdmin'] = false;
					header('Location: index.php');
					exit();
				} else {
					echo "Error SQL ({$conn->errno}):  {$conn->error}";
					exit();
				}
			} else {
				echo "Error SQL ({$conn->errno}):  {$conn->error}";
				exit();
			}
		}		
	} else {
		echo "Error SQL ({$conn->errno}):  {$conn->error}";
		exit();
	}
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
	<article>
		<h1>Registro de usuario</h1>
		<?= generaErroresGlobalesFormulario($erroresFormulario) ?>
		<form action="procesarRegistro.php" method="POST">
		<fieldset>
            <legend>Datos para el registro</legend>
            
            <div>
                <label for="nombre">Nombre:</label>
				<input id="nombre" type="text" name="nombre" value="<?= $nombre ?>" />
				<?=  generarError('nombre', $erroresFormulario) ?>
            </div>
            <div>

			<div>
                <label for="apellido1">Apellido 1:</label>
				<input id="apellido1" type="text" name="apellido1" value="<?= $apellido1 ?>" />
				<?=  generarError('apellido1', $erroresFormulario) ?>
            </div>

			<div>
                <label for="apellido2">Apellido 2:</label>
				<input id="apellido2" type="text" name="apellido2" value="<?= $apellido2 ?>" />
				<?=  generarError('apellido2', $erroresFormulario) ?>
            </div>

			<div>
                <label for="dni">DNI:</label>
				<input id="dni" type="text" name="dni" value="<?= $dni ?>" />
				<?=  generarError('dni', $erroresFormulario) ?>
            </div>

			<div>
                <label for="correo_electronico">Correo electrónico:</label>
				<input id="correo_electronico" type="text" name="correo_electronico" value="<?= $correo_electronico ?>" />
				<?=  generarError('correo_electronico', $erroresFormulario) ?>
            </div>

            <div>
                <label for="password">Contraseña:</label>
				<input id="password" type="password" name="password" value="<?= $password ?>" />
				<?=  generarError('password', $erroresFormulario) ?>
            </div>
            <div>
                <label for="password2">Reintroduce la contraseña:</label>
				<input id="password2" type="password" name="password2" value="<?= $password2 ?>" />
				<?=  generarError('password2', $erroresFormulario) ?>
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
