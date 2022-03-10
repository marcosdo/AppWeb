<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="../../resources/CSS/estiloaux.css" />

        <title>Planificación</title>

        <?php?>
    </head>
    <body>
        <div id="contenedor">
            <?php 
                require '../layout/cabecera.php'; 
                require '../layout/menu.php';
            ?>
                <?php
                session_start();
				function conectar ($host, $usuario, $contraseña,$nombreBD){
					$mysqli = new mysqli($host,$usuario,$contraseña,$nombreBD);
					if ($mysqli->connect_errno) {
						echo "ERROR Conexion";
					}
					return $mysqli;     
                }
                $BD = conectar("localhost","root","","practica 2 aw");
              
                $nivel = isset($_POST["nivel"]) ? $_POST["nivel"] : null;
                $objetivo = isset($_POST["Rutina"]) ? $_POST["Rutina"] : null;
                $ndias = isset($_POST["Dias"]) ? $_POST["Dias"] : null;
                
                $consulta = mysqli_query($BD,"SELECT * FROM usuario");
                $fila = mysqli_fetch_assoc($consulta);
                echo $fila["Nombre"];
                echo $objetivo;
                echo $nivel;
                $sql = "UPDATE usuario SET Nivel = '$nivel',  Eobjetivo = '$objetivo', Dias = '$ndias' WHERE Nombre = '$fila[Nombre]'";

                /*
                $consulta = mysqli_query($BD,$sql); 
                mysqli_query($BD,$sql);  
                while($fila = mysqli_fetch_assoc($consulta)){
                  // if($fila['Nombre'] ==  "Alex"){ 
                        //INSERT INTO usuario (Nombre, Apellido 1, Apellido 2, DNI, Correo, Contraseña, Id_usuario, Premium, Nivel, Dias, Eobjetivo)
                        $fila["Nivel"] = $nivel;
                        $fila["Eobjetivo"] = $objetivo;
                        UPDATE usuario SET Nivel = $nivel,  Eobjetivo = $objetivo WHERE $fila["Nombre"] = "Alex";
                }
                }*/
             
            ?>
             <?php 
                require '../layout/anuncios.php';
                require '../layout/pie.php';
            ?>
        </div>
    </body>
</html>