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
		<header><h1>Tu  nutricionista/entrenador personal ENTRENADOR </h1></header>
			<p></p>
			<div id = "logros" >
			 
				
			<h1><span class = 'text'>L O G R O S</span></h1>
				<div id = 'selectA'>
				<h3><span class = 'textD'>Seleccione el Logro :</span></h3>
				<h3><span class = 'textI' >Seleccione al Usuario :</span></h3>
				</div>
				<form method='post'>
				<div id = 'select' >
				<select name = 'logrosE' id = 'logrosE' type = 'text' class = 'selectA'>
				<option value='5logros'>Completar 5 Logros</option>
				<option value='AccesoTodos'>Acceso a todas las areas</option>
				<option value='ComenzarChat'>Comenzar chat</option>
				<option value='Completa1Plan'>Completar 1 plan</option>
				<option value='Completa5Plan'>Completar 5 plan</option>
				<option value='ContrataNutri'>Contratar un Nutricionista</option>
				<option value='Foro'>Entrar en el foro</option>
				<option value='Permanencia'>Sesión 5 dias seguidos</option>
				<option value='Permanencia1m'>Sesión 1 mes seguidos</option>
				</select>
				<select name = 'idE' id = 'idE' type = 'text' class = 'selectB'>
				<?php 
				function conectar ($host, $usuario, $contraseña,$nombreBD){
					$mysqli = new mysqli($host,$usuario,$contraseña,$nombreBD);
					if ($mysqli->connect_errno) {
						echo "ERROR Conexion";
					}
					return $mysqli;
				}
				$BD = conectar("localhost","root","","lifety");
				session_start();
				$_SESSION['login'] = 'Entrenador1';

				$consulta = mysqli_query($BD,"SELECT * FROM profesional WHERE id_profesional = '$_SESSION[login]'");
				$BDLogros =  mysqli_fetch_array($consulta);
				$cadena = explode(",",$BDLogros["usuarios"]);
				foreach($cadena as $usuario){
					echo "<option value='$usuario'>$usuario</option>";
				}
				?>
				</select>
				</div>
				<div id = 'select'>
				<?php 
				echo "<h3>";
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
						echo "<span class ='text1'>Completado</span>";
					} 
					else echo "<span class='text2'>Ya tiene este logro</span>";

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
						echo "<span class ='text1'>Completado</span>";
					}
					else echo "<span class='text2'>No posee este logro</span>";
				}
				echo "</h3>";
				?>
				</div>
				<div id = 'select'>
				<input type='submit' class = 'ButtonD' name='quitarLogro' value='Quitar Logro'/>
				<input type='submit' class = 'ButtonI' name='buttonLogro' value='Añadir Logro'/>
				</div>
				</form>
			</div>


			<form method="post">
			<div id="wrapper">
				<div id="menu">
				<h1><span class = 'text'>C H A T &nbsp C O N &nbsp U S U A R I O</span></h1>
        		<span class="welcome" >Welcome, <?php echo $_SESSION['login'] ?></span>
				<span class = 'text'> Elige usuario: </span>
				<select name = 'idE2' id = 'idE2' type = 'text' >
				<?php 
				foreach($cadena as $usuario){
					echo "<option value='$usuario'>$usuario</option>";
				}
				?>
				</select>
				<input name='actua' type='submit'  id='actua' value='Actualizar Chat' />
			</div>
    		<div id="chatbox"></div>
			<?php
				if(isset($_POST['idE3'])) {
					if(isset($_POST['submitmsg'])) {
						$fecha = date_create()->format('Y-m-d H:i:s');
						mysqli_query($BD,"INSERT INTO chat (Origen,Receptor,Contenido,Tiempo,Tipo) VALUES ('$_SESSION[login]','$_POST[idE3]','$_POST[usermsg]','$fecha','E-U') ");
					}
				}
				$data = "";
				if(isset($_POST['idE2'])) {
					$data =  "[". $data . $_SESSION["login"] . " 🡺 " . $_POST["idE2"] . "]";
					$consulta = mysqli_query($BD,"SELECT * FROM chat WHERE (Origen = '$_SESSION[login]' AND Receptor = '$_POST[idE2]') OR (Origen = '$_POST[idE2]' AND Receptor = '$_SESSION[login]') ORDER BY Tiempo ASC ");
					while($chats = mysqli_fetch_array($consulta)){
						if($chats["Tipo"] == "E-U")$data = $data . "\n". "🡺 (" . $chats["Tiempo"] . ") " . $chats["Origen"] . ": " . $chats["Contenido"];
						else $data = $data . "\n". "🡸 [" . $chats["Tiempo"] . "] " . $chats["Origen"] . ": " . $chats["Contenido"];
					}
				}else{
					$data = $data . "Debes Actualizar Chat para ver la información";
				}
				echo "<textarea rows= '10' name = 'msg' readonly= 'readonly' class = 'chat'>";
				echo $data;
				echo "</textarea>";
			?>
        	<input name="usermsg" type="text" id="usermsg" size="63" />
			<span class = 'text'>D: </span>
				<select name = 'idE3' id = 'idE3' type = 'text' >
				<?php
				foreach($cadena as $usuario){
					echo "<option value='$usuario'>$usuario</option>";
				}
				?>
				</select>
        	<input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    		</form>
			</div>
	</main>
    <?php 
		include("sidebarDer.php");
		include("pie.php");
	?>
    </div> 
</body>
</html>