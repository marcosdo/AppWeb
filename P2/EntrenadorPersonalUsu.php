<?php
	function conectar ($host, $usuario, $contraseña,$nombreBD){
		$mysqli = new mysqli($host,$usuario,$contraseña,$nombreBD);
		if ($mysqli->connect_errno) {
			echo "ERROR Conexion";
		}
		return $mysqli;
	}
	$BD = conectar("localhost","root","","lifety");
	$_SESSION['login'] = 'Usuario1';
	$consulta = mysqli_query($BD,"SELECT * FROM premium WHERE id_usuario = '$_SESSION[login]'"); 
	$usu =  mysqli_fetch_array($consulta);
	$usuLogros = $usu["num_logros"];
	$EnumLogros = $usu["logros"];
	$usuEntrenador = $usu["id_profesional"];
	$usuNombre =  $_SESSION["login"];
	function LogrosImg($EnumLogros){
		$rts = "";
		$logro = "";
		
		for($i = 0; $i < strlen($EnumLogros); $i++){
			if($EnumLogros[$i] == ","){
				$logro = $logro . ".png";
				$rts = $rts . "<img src='img/logros/$logro' alt='' width='70' height='70'>";
				$logro = "";
			}
			else $logro = $logro . $EnumLogros[$i];
			if($i+1 == strlen($EnumLogros)){
				$logro = $logro . ".png";
				$rts = $rts . "<img src='img/logros/$logro' alt='' width='70' height='70'>";
			}
		}
		return $rts;
	}
	$imaginesLogros = LogrosImg($EnumLogros);

	if(isset($_POST['submitmsg'])) {
		$fecha = date_create()->format('Y-m-d H:i:s');
		mysqli_query($BD,"INSERT INTO chat (Origen,Receptor,Contenido,Tiempo,Tipo) VALUES ('$_SESSION[login]','$usu[id_profesional]','$_POST[usermsg]','$fecha','U-E') ");
	}
	function dataChat($nombreUsu,$nombreEnt,$BD){
		$rts = "";
		$data = "[" . $nombreUsu . " 🡺 " . $nombreEnt . "]";
		$consulta = mysqli_query($BD,"SELECT * FROM chat WHERE (Origen = '$nombreUsu' AND Receptor = '$nombreEnt') OR (Origen = '$nombreEnt' AND Receptor = '$nombreUsu') ORDER BY Tiempo ASC ");
		while($chats = mysqli_fetch_array($consulta)){
			if($chats["Tipo"] == "E-U")$data = $data . "\n". "🡸 [" . $chats["Tiempo"] . "] " . $chats["Origen"] . ": " . $chats["Contenido"];
			else $data = $data . "\n". "🡺 [" . $chats["Tiempo"] . "] " . $chats["Origen"] . ": " . $chats["Contenido"];
					
		}
		$rts = $rts ."<textarea rows= '10' name = 'msg' readonly= 'readonly' class = 'chat'>";
		$rts = $rts . $data;
		$rts = $rts . "</textarea>";
		return $rts;
	}

	$dataChat = dataChat($usuNombre,$usuEntrenador,$BD);
require_once __DIR__.'/includes/config.php';
$tituloPagina = 'EntrenadorUsu';


$contenidoPrincipal = <<<EOS
<header><h1>Tu nutricionista/entrenador personal </h1></header>
	<div id = "logros">
		<h1><span class = 'text'>T U S &nbsp L O G R O S</span></h1>
		<div id = 'selectA'>
		<h3><span class = 'text'>Número de logros : &nbsp<b>$usuLogros</b></span></h3>
		</div>
		<div id = 'selectA'>
			$imaginesLogros
		</div>
	</div>
	<form method="post">
		<div id="wrapper">
			<h1><span class = 'text'>C H A T &nbsp E N T R E N A D O R</span></h1>
        	<span class="welcome">&nbsp &nbspBienvenido, <b>$usuNombre</b>
			&nbsp &nbsp Tu entrenador es  <b>$usuEntrenador</b>
			</span>
			<div id="chatbox"></div>
			$dataChat
			<input name="usermsg" type="text" id="usermsg" size="63" />
			<input type="submit"  name="submitmsg" value="send"/>
		</div>
	</form>
EOS;

  require __DIR__.'/includes/vistas/plantillas/plantilla.php';