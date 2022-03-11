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


                htmlspecialchars(trim(strip_tags($_POST["nivel"])));
                htmlspecialchars(trim(strip_tags($_POST["Rutina"])));
                htmlspecialchars(trim(strip_tags($_POST["Dias"])));

                $nivel = isset($_POST["nivel"]) ? $_POST["nivel"] : null;
                $objetivo = isset($_POST["Rutina"]) ? $_POST["Rutina"] : null;
                $dias = isset($_POST["Dias"]) ? $_POST["Dias"] : null;
                $consulta = mysqli_query($BD,"SELECT * FROM usuario");
                $fila = mysqli_fetch_assoc($consulta);
                $sql = "UPDATE usuario SET Nivel = '$nivel', Dias = '$dias',  Eobjetivo = '$objetivo' WHERE Nombre = '$fila[Nombre]'";

                 // -->Nivel principiante: 2 +2
                 // -->Nivel medio: 3 +3
                 // -->Nivel avanzado:4 + 4
               $muscs = array(
                    1 => "Pecho",
                    2 => "Hombro",
                    3 => "Espalda",
                    4 => "Biceps",
                    5 => "Pierna",
                    6 => "Triceps",
                );
            switch ($nivel) {
                case "P":
                    $ejerciciosdia = 2;
                    break;
                case "M":
                    $ejerciciosdia = 3;
                    break;
                case "A":
                    $ejerciciosdia = 4;                        
                    break;
            }
            $cont = 1;
            echo "<table>";
            for($i = 1; $i < $dias +1; $i++){
                echo "<tr>";
                echo "<td> Dia $i</td>";
                if($i == 4) {
                    $cont = 1;
                    $ejerciciosdia--;
                }
                if($i >= 1 && $i <= 3) mostrar($cont, $ejerciciosdia, $muscs, $BD, 2);
                else mostrar($cont, $ejerciciosdia, $muscs, $BD, 3);
                echo "</tr>";
            }
            echo "</table>";

            function mostrar(&$cont, $ejerciciosdia, $muscs, $BD, $nveces){
                for($i = 0; $i < $nveces; $i++){
                    $j = 0;
                    $consulta = mysqli_query($BD,"SELECT * FROM ejercicios WHERE Musculo = '$muscs[$cont]'");
                    while ($fila = mysqli_fetch_assoc($consulta)){
                        if($j < $ejerciciosdia) echo "<td> $fila[Nombre]</td>";  
                        $j++;
                    }
                    $cont++;
                 }
            }
            
                require '../layout/anuncios.php';
                require '../layout/pie.php';
            ?>
        </div>
    </body>
</html>