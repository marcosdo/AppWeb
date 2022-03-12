<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="../../resources/CSS/estiloaux4.css" />

        <title>Planificación</title>

        <?php?>
    </head>
    <body>
        <div id="contenedor">
            <?php 
                require '../layout/cabecera.php'; 
                require '../layout/menu.php';
            ?>
            <main>
           
                <?php
                htmlspecialchars(trim(strip_tags($_POST["nivel"])));
                htmlspecialchars(trim(strip_tags($_POST["Rutina"])));
                htmlspecialchars(trim(strip_tags($_POST["Dias"])));

                $nivel = isset($_POST["nivel"]) ? $_POST["nivel"] : null;
                $objetivo = isset($_POST["Rutina"]) ? $_POST["Rutina"] : null;
                $dias = isset($_POST["Dias"]) ? $_POST["Dias"] : null;

                $BD = conectar("localhost","root","","practica 2 aw");
                $consulta = mysqli_query($BD,"SELECT * FROM usuario");
                $fila = mysqli_fetch_assoc($consulta);
                $sql = "UPDATE usuario SET Nivel = '$nivel', Dias = '$dias',  Eobjetivo = '$objetivo' WHERE Nombre = '$fila[Nombre]'";

                /* 
                Ejercicios x musculo
                  -->Nivel principiante: 2 + 2
                  -->Nivel medio: 3 + 3
                  -->Nivel avanzado: 4 + 4
                */

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
                $dia4 = array(); 
                $dia5 = array(); 
                $cont = 1;
                for($i = 1; $i < $dias +1; $i++){
                    $arrayaux = array();
                    if($i == 4) {
                        $cont = 1;
                        $ejerciciosdia--;
                    }
                    if($i >= 1 && $i <= 3) {
                        rellenar($cont, $ejerciciosdia, $muscs, $BD, 2, $arrayaux);
                        if($i == 1) $dia1 = $arrayaux; 
                        else if($i == 2) $dia2 = $arrayaux;
                        else $dia3 = $arrayaux;
                    }
                    else{
                        rellenar($cont, $ejerciciosdia, $muscs, $BD, 3, $arrayaux);
                        if($i == 4) $dia4 = $arrayaux; 
                        else $dia5 = $arrayaux;
                    }
                }
                mostrar($ejerciciosdia, $dias, $dia1, $dia2, $dia3, $dia4, $dia5);

                function rellenar(&$cont, $ejerciciosdia, $muscs, $BD, $nveces , &$arrayaux){
                    for($i = 0; $i < $nveces; $i++){
                        $j = 0;
                        $consulta = mysqli_query($BD,"SELECT * FROM ejercicios WHERE Musculo = '$muscs[$cont]'");
                        while ($fila = mysqli_fetch_assoc($consulta)){
                            if($j < $ejerciciosdia) array_push($arrayaux, $fila['Nombre']);  
                            $j++;
                        }
                        $cont++;
                    } 
                }
                
                function mostrar($ejerciciosdia, $dias, $dia1, $dia2, $dia3, $dia4, $dia5){
                    if($dias == 3) $ejerciciostotales = $ejerciciosdia * 2;
                    else if ($dias == 5)  $ejerciciostotales = $ejerciciosdia * 3;
                    echo "<table><tr>";
                    for( $dia_actual = 1; $dia_actual <= $dias; $dia_actual++)
                        echo "<td> Dia $dia_actual:  </td>";
                    echo "</tr>";
                    for ($i = 0; $i < $ejerciciostotales; $i++){
                        echo "<tr>";
                        for($j = 1; $j < $dias+1; $j++){
                            switch ($j) {
                                case 1: 
                                    print "<td> $dia1[$i] </td>";
                                    break;
                                case 2:
                                    print "<td> $dia2[$i] </td>";
                                    break;
                                case 3:
                                    print "<td> $dia3[$i] </td>";
                                    break;
                                case 4:
                                    print "<td> $dia4[$i] </td>";
                                    break;
                                case 5:
                                    print "<td> $dia5[$i] </td>";
                                    break;
                                default:
                                    break;
                            }   
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                }

                function conectar ($host, $usuario, $contraseña,$nombreBD){
					$mysqli = new mysqli($host,$usuario,$contraseña,$nombreBD);
					if ($mysqli->connect_errno) {
						echo "ERROR Conexion";
					}
					return $mysqli;     
                }
                
                ?>
           
            </main>
            <?php 
                require '../layout/anuncios.php';
                require '../layout/pie.php';
            ?>
        </div>
    </body>
</html>