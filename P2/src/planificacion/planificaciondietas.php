<?php
    session_start();
?>

<?php
    // Coger del formulario el valor de la dieta
    htmlspecialchars(trim(strip_tags($_POST["Dieta"])));
    // Si existe, asignarlo a la variable 
    $objetivo = isset($_POST["Dieta"]) ? $_POST["Dieta"] : null;
    echo "el objetivo es " . $objetivo;
    $BD = conectar("localhost","root","","lifety");
    $consulta = mysqli_query($BD,"SELECT * FROM usuario");
    $fila = mysqli_fetch_assoc($consulta);
    $sql = "UPDATE usuario SET usuario.Dobjetivo = '$objetivo' WHERE usuario.Id_usuario = '$_SESSION[id_usuario]'";

    // Arrays con todos las comidas de un tipo y un objetivo
    $desayunos_aux = array(); 
    $comidas_aux = array(); 
    $cenas_aux = array();
    
    // Trae de la base de datos los desayunos y los mete
    fill_array($desayunos_aux, "Desayuno", $objetivo, $BD);
    fill_array($comidas_aux, "Comida", $objetivo, $BD);
    fill_array($cenas_aux, "Cena", $objetivo, $BD);

    $desayunos = array(); 
    $comidas = array(); 
    $cenas = array();

    // Rellena los arrays con comidas aleatorias
    fill_random($desayunos, $desayunos_aux);
    fill_random($comidas, $comidas_aux);
    fill_random($cenas, $cenas_aux);

?>
<?php
    // FUNCIONES AUXILIARES
    function fill_array(&$dest, $tipo, $objetivo, $BD) {
        // Consulta que te devuelve el numero de elementos que hay de ese tipo 
        $consulta = mysqli_query($BD, "SELECT dietas.Nombre FROM dietas WHERE dietas.Tipo = '$tipo' AND dietas.Objetivo = '$objetivo'"); 
        while ($fila = mysqli_fetch_assoc($consulta)){
            array_push($dest, $fila['Nombre']);
        }
    }
    
    // Inserta siete (7) elementos en el array destino
    function fill_random(&$dest, $src) {
        // Si esta vacio no hace nada
        if (empty($src)) {
            return;
        }
        // Por cada dia de la semana
        for ($i = 0; $i < 7; $i++) {
            $clave = array_rand($src, 1); 
            $dest[] =  $src[$clave];
        }
    }

    // Conectar con la base de datos
    function conectar ($host, $usuario, $contraseña, $nombreBD){
        $mysqli = new mysqli($host, $usuario, $contraseña, $nombreBD);
        if ($mysqli->connect_errno) {
            echo "ERROR Conexion";
        }
        return $mysqli;
    }

    // Funcion que muestra la tabla
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

            </main>
            <?php 
                require '../includes/vistas/anuncios.php';
                require '../includes/vistas/pie.php';
            ?>
        </div>
    </body>
</html>