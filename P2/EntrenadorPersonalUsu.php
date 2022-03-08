<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
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
		<header><h1>Tu nutricionista/entrenador personal</h1></header>
			
			<div id = "chat">
				aqui va un chat
			</div>

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
				$BD = conectar("localhost","root","","aw");
				$_SESSION['login'] = 'diego';
				$consulta = mysqli_query($BD,"SELECT * FROM Logros WHERE id = '$_SESSION[login]'"); 
				$usu =  mysqli_fetch_array($consulta);
				echo $usu["num"];
				
			?>
			</div>

	</main>
    <?php 
		include("sidebarDer.php");
		include("pie.php");
	?>
    </div> <!-- Fin del contenedor -->
</body>
</html>