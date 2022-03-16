<?php
/*function conectar ($host, $usuario, $contraseña,$nombreBD){
	$mysqli = new mysqli($host,$usuario,$contraseña,$nombreBD);
	if ($mysqli->connect_errno) {
		echo "ERROR Conexion";
	}
	return $mysqli;
}
$BD = conectar("localhost","root","","lifety");
$_SESSION['login'] = 'Entrenador1';
$entNombre = $_SESSION['login'];
function Usuarios($BD , $entNombre){
	$rts = "";
	$consulta = mysqli_query($BD,"SELECT * FROM profesional WHERE id_profesional = '$entNombre'");
	$BDLogros =  mysqli_fetch_array($consulta);
	$cadena = explode(",",$BDLogros["usuarios"]);
	foreach($cadena as $usuario){
		$rts = $rts ."<option value='$usuario'>$usuario</option>";
	}
	return $rts;
}
$SelectUsuarios = Usuarios($BD , $entNombre);*/
/*
$alert = "";

if(isset($_POST['buttonLogro'])) {
	$logroE = $_POST["logrosE"];
	$id = $_POST["idE"];
	$consulta = mysqli_query($BD,"SELECT * FROM premium WHERE id_usuario = '$id'"); 
	$usu = mysqli_fetch_array($consulta);
	$EnumLogros = $usu["logros"];
	if(!preg_match("/{$logroE}/i",$EnumLogros)){
		$EnumLogros = $EnumLogros . "," . $logroE;
		$num = $usu["num_logros"];
		$num++;
		mysqli_query($BD,"UPDATE premium SET num_logros = '$num', logros = '$EnumLogros' WHERE id_usuario = '$id' ");
		$alert = "<span class ='text1'>Completado</span>";
	} 
	else $alert = "<span class='text2'>Ya tiene este logro</span>";

}
if(isset($_POST['quitarLogro'])) {
	$logroE = $_POST["logrosE"];
	$id = $_POST["idE"];
	$consulta = mysqli_query($BD,"SELECT * FROM premium WHERE id_usuario = '$id'"); 
	$usu = mysqli_fetch_array($consulta);
	$EnumLogros = $usu["logros"];
	if(preg_match("/{$logroE}/i",$EnumLogros)){
		$EnumLogrosEliminado = str_replace($logroE ,'',$EnumLogros);
		$num = $usu["num_logros"];
		$num--;
		mysqli_query($BD,"UPDATE premium SET num_logros = '$num', logros = '$EnumLogrosEliminado' WHERE id_usuario = '$id' ");
		$alert = "<span class ='text1'>Completado</span>";
	}
	else $alert = "<span class='text2'>No posee este logro</span>";
}
*/


require_once __DIR__.'/includes/config.php';

$chatUsuario = new es\ucm\fdi\aw\ChatEntrenador();
$MostrarChat = $chatUsuario->mostrarChat();

require_once __DIR__ .'/includes/FormularioLogros.php';

$FormularioLogros = new es\ucm\fdi\aw\FormularioLogros();
$MostrarLogros = $FormularioLogros->mostrarFormulario();

$tituloPagina = 'Entrenador';

$contenidoPrincipal = <<<EOS
<header><h1>Tu  nutricionista/entrenador personal ENTRENADOR </h1></header>
<form method='post'>
<div id = "logros" >
	$MostrarLogros
</div>
	$MostrarChat
</form>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';