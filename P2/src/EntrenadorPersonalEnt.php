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
		include("../layout/cabecera.php");
		include("../layout/sidebarIzq.php");
	?>
    <main>
		<header><h1>Tu nutricionista/entrenador personal ENTRENADOR</h1></header>
			
			<div id = "chat">
				aqui va un chat
			</div>
			<div id = "logros">
			<?php 
				function conectar ($host, $usuario, $contraseña,$nombreBD){
					$mysqli = new mysqli($host,$usuario,$contraseña,$nombreBD);
					if ($mysqli->connect_errno) {
						echo "ERROR Conexion";
					}
					return $mysqli;
				}

				$BD = conectar("localhost","root","","aw");
				$consulta = mysqli_query($BD,"SELECT * FROM Logros"); 

				echo "<form method='post'>
				<select name = 'idE' id = 'idE' type = 'text'>";
				while($BDLogros =  mysqli_fetch_array($consulta)){
					echo "<option value='$BDLogros[id]'>$BDLogros[id]</option>";
				}
				echo "</select>";
		
				if(isset($_POST['buttonLogro'])) {
					$id = $_POST["idE"];
					$consulta = mysqli_query($BD,"SELECT num FROM Logros WHERE id = '$id'"); 
					$usu = mysqli_fetch_array($consulta);
					$num = $usu["num"];
					$num++;
					mysqli_query($BD,"UPDATE Logros SET num = '$num' WHERE id = '$id' ");
				}
				echo " <input type='submit' name='buttonLogro' value='darLogro'/>
				</form>"
			?>
			</div>

	</main>
    <?php 
		include("../layout/sidebarDer.php");
		include("../layout/pie.php");
	?>
    </div> <!-- Fin del contenedor -->
</body>
</html>