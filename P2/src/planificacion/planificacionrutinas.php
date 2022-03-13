<?php
    session_start();
?>

<?php
    htmlspecialchars(trim(strip_tags($_POST["nivel"])));
    htmlspecialchars(trim(strip_tags($_POST["Rutina"])));
    htmlspecialchars(trim(strip_tags($_POST["Dias"])));

    $nivel = isset($_POST["nivel"]) ? $_POST["nivel"] : null;
    $objetivo = isset($_POST["Rutina"]) ? $_POST["Rutina"] : null;
    $dias = isset($_POST["Dias"]) ? $_POST["Dias"] : null;

    $BD = conectar("localhost","root","","lifety");
    $consulta = mysqli_query($BD,"SELECT * FROM usuario");
    $fila = mysqli_fetch_assoc($consulta);
    $sql = "UPDATE usuario SET Nivel = '$nivel', Dias = '$dias',  Eobjetivo = '$objetivo' WHERE Nombre = '$fila[Nombre]' AND Id_usuario = '$_SESSION[id_usuario]'";

    /* 
    Ejercicios x musculo
      -->Nivel principiante: 2 + 2
      -->Nivel medio: 3 + 3
      -->Nivel avanzado: 4 + 4
    Repeticiones x musculo
      -->Fuerza:6
      -->Hipertrofia: 10
      -->Resistencia: 16
    Nº series: 3
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
    for ($i = 1; $i < $dias +1; $i++) {
        $arrayaux = array();
        if ($i == 4) {
            $cont = 1;
        }
        if ($i >= 1 && $i <= 3) {
            rellenar($cont, $ejerciciosdia, $muscs, $BD, 2, $arrayaux);
            if ($i == 1)
                $dia1 = $arrayaux; 
            else if ($i == 2) 
                $dia2 = $arrayaux;
            else $dia3 = $arrayaux;
        }
        else {
            rellenar($cont, $ejerciciosdia, $muscs, $BD, 3, $arrayaux);
            if($i == 4) $dia4 = $arrayaux; 
            else $dia5 = $arrayaux;
        }
    }

    function conectar ($host, $usuario, $contraseña,$nombreBD){
        $mysqli = new mysqli($host,$usuario,$contraseña,$nombreBD);
        if ($mysqli->connect_errno) {
            echo "ERROR Conexion";
        }
        return $mysqli;     
    }
    // Funcion que rellena los arrays de cada dia
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
                require '../includes/vistas/cabecera.php'; 
                require '../includes/vistas/menu.php';
            ?>
            <main>
           
            <?php 
                mostrar($ejerciciosdia, $dias, $dia1, $dia2, $dia3, $dia4, $dia5,$objetivo);
                $idusuario = 123;
                $sqlu = "UPDATE usuario
                SET Nivel = $nivel, Dias = $dias, Eobjetivo = $objetivo
                WHERE Id_usuario = $idusuario";
                mysqli_query($BD, $sqlu); // Tratar error en caso de que no se actualice.
                mysqli_close($BD);

                // FUNCION QUE MUESTRA LA TABLA 
                function mostrar($ejerciciosdia, $dias, $dia1, $dia2, $dia3, $dia4, $dia5, $objetivo){
                    if ($dias == 3) 
                        $ejerciciostotales = $ejerciciosdia * 2;
                    else if ($dias == 5)  
                        $ejerciciostotales = $ejerciciosdia * 3;
                    // Empieza la tabla
                    echo "<table><caption>Rutina de entrenamiento:</caption><tr>";
                    // Celdas con los dias
                    for ($dia_actual = 1; $dia_actual <= $dias; $dia_actual++)
                        echo "<th>Día $dia_actual</th>";
                    // Fin de linea
                    echo "</tr>";
                    // Por cada fila de ejercicios
                    for ($i = 0; $i < $ejerciciostotales; $i++) {
                        // Empieza una linea
                        echo "<tr>";
                        // Por cada fila
                        for($j = 1; $j < $dias + 1; $j++){
                            // Dependiendo del dia, mete su valor asociado
                            switch ($j) {
                                case 1:
                                    if ($i < sizeof($dia1))
                                        print "<td> $dia1[$i] </td>";
                                    else echo "<td></td>";
                                    break;
                                case 2:
                                    if ($i < sizeof($dia2))
                                        print "<td> $dia2[$i] </td>";
                                    else echo "<td></td>";
                                    break;
                                case 3:
                                    if ($i < sizeof($dia3))
                                        print "<td> $dia3[$i] </td>";
                                    else echo "<td></td>";
                                    break;
                                case 4:
                                    if ($i < sizeof($dia4))
                                        print "<td> $dia4[$i] </td>";
                                    else echo "<td></td>";
                                    break;
                                case 5:
                                    if ($i < sizeof($dia5))
                                        print "<td> $dia5[$i] </td>";
                                    else echo "<td></td>";
                                    break;
                                default:
                                    break;
                            }   
                        }
                        // Fin de linea
                        echo "</tr>";
                    }
                    // Fin de tabla
                    echo "</table>";
                }
                ?>

                <div>
                    <p>Numero de repeticiones por ejercicio:
                    <?php
                    if ($objetivo == 1)
                        echo "6.";
                    else if ($objetivo == 2)
                        echo "10.";
                    else echo "16.";
                     ?>
                    </p>
                    <p>Numero de series: 3.</p>
                </div>
            </main>
            <?php 
                require '../includes/vistas/anuncios.php';
                require '../includes/vistas/pie.php';
            ?>
        </div>
    </body>
</html>