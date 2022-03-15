<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/estiloD.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>login</title>
</head>

<body>
<div id="contenedor">
    <?php 
		include("cabecera.php");
		include("sidebarIzq.php");
	?>
    <main>
		<header><h1>Tu nutricionista/entrenador personal </h1></header>
			<div id = "logros">
			<?php 
				session_start();
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
			?>	
				<h1><span class = 'text'>T U S &nbsp L O G R O S</span></h1> 
			<div id = 'selectA'>
				<h3><span class = 'text'>Número de logros : &nbsp<b><?php echo $usu["num_logros"]?></b></span></h3>
			</div>
				<div id = 'selectA'>
				<?php 
				$EnumLogros = $usu["logros"];
				$logro = "";
				for($i = 0; $i < strlen($EnumLogros); $i++){
					if($EnumLogros[$i] == ","){
						$logro = $logro . ".png";
						echo "<img src='logros/$logro' alt='' width='70' height='70'>";
						$logro = "";
					}
					else $logro = $logro . $EnumLogros[$i];
					if($i+1 == strlen($EnumLogros)){
						$logro = $logro . ".png";
						echo "<img src='logros/$logro' alt='' width='70' height='70'>";
					}
				}
				?>
				</div>
			
			</div>
			<form method="post">
			<div id="wrapper">
				<div id="menu">
				<h1><span class = 'text'>C H A T &nbsp E N T R E N A D O R</span></h1>
        		<span class="welcome">Bienvenido, <b><?php echo $_SESSION["login"] ?></b>
				&nbsp &nbsp Tu entrenador es  <b><?php echo $usu["id_profesional"];?></b>
			</span>
			</div>
    		<div id="chatbox"></div>
			<?php
				if(isset($_POST['submitmsg'])) {
					$fecha = date_create()->format('Y-m-d H:i:s');
					mysqli_query($BD,"INSERT INTO chat (Origen,Receptor,Contenido,Tiempo,Tipo) VALUES ('$_SESSION[login]','$usu[id_profesional]','$_POST[usermsg]','$fecha','U-E') ");
				}

				$data = "[" . $_SESSION["login"] . " 🡺 " . $usu["id_profesional"] . "]";
				$consulta = mysqli_query($BD,"SELECT * FROM chat WHERE (Origen = '$_SESSION[login]' AND Receptor = '$usu[id_profesional]') OR (Origen = '$usu[id_profesional]' AND Receptor = '$_SESSION[login]') ORDER BY Tiempo ASC ");
				while($chats = mysqli_fetch_array($consulta)){
					if($chats["Tipo"] == "E-U")$data = $data . "\n". "🡸 [" . $chats["Tiempo"] . "] " . $chats["Origen"] . ": " . $chats["Contenido"];
					else $data = $data . "\n". "🡺 [" . $chats["Tiempo"] . "] " . $chats["Origen"] . ": " . $chats["Contenido"];
					
				}
				echo "<textarea rows= '10' name = 'msg' readonly= 'readonly' class = 'chat'>";
				echo $data;
				echo "</textarea>";
			?>
        	<input name="usermsg" type="text" id="usermsg" size="63" />
			<input type="submit"  name="submitmsg" value="send"/>
			</div>
		</form>
	</main>
    <?php 
		include("sidebarDer.php");
		include("pie.php");
	?>
    </div> <!-- Fin del contenedor -->
</body>
