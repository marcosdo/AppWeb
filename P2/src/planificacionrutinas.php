<?php session_start(); ?>

<?php

// Coger los datos del formulario
// nivel = CHAR: ['P', 'M', 'A']
htmlspecialchars(trim(strip_tags($_POST["nivel"])));
// rutina = INT: [1, 2, 3]
htmlspecialchars(trim(strip_tags($_POST["rutina"])));
// dias = INT: [3, 5]
htmlspecialchars(trim(strip_tags($_POST["dias"])));
// Si los datos existen los mete en variables
$nivel      = isset($_POST["nivel"])    ? $_POST["nivel"]   : null;
$objetivo   = isset($_POST["rutina"])   ? $_POST["rutina"]  : null;
$dias       = isset($_POST["dias"])     ? $_POST["dias"]    : null;

/* ===============================
SI LOS DATOS NO EXISTEN ERROR AQUI
=============================== */

// Conenctar con la base de datos
$BD = conectar_bd("localhost", "root", "", "lifety");

/* ====================================
SI LA BASE DE DATOS NO EXISTE ERROR AQUI
===================================== */

$query = "UPDATE planificacion SET  
WHERE planificacion.id_usuario = '$_SESSION[id_usuario]'";
mysqli_query($BD, $query);


/* 
Ejercicios por musculo
    -->Nivel principiante: 2 + 2
    -->Nivel medio: 3 + 3
    -->Nivel avanzado: 4 + 4
Repeticiones por musculo
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
    case "P": $ejerciciosdia = 2; break;
    case "M": $ejerciciosdia = 3; break;
    case "A": $ejerciciosdia = 4; break;
}




$dia4 = array(); 
$dia5 = array(); 
$cont = 1;
$string = "";

$sqlselect = "SELECT * FROM planificacion WHERE planificacion.id_usuario = '$_SESSION[id_usuario]'";
$resultado = $BD->query($sqlselect); 
$fila = mysqli_fetch_assoc($resultado);
if(is_null($fila["eobjetivo"]) || is_null($fila["dias"])|| is_null($fila["nivel"]) || is_null($fila["rutina"])
 || $dias != $fila["dias"] || $objetivo != $fila["eobjetivo"] || $nivel != $fila["nivel"]){
    for ($i = 1; $i < $dias +1; $i++) {
        $arrayaux = array();
        $stringaux = "";

        if ($i == 4) {
            $cont = 1;
        }
        if ($i >= 1 && $i <= 3) {
            llenar_array($cont, $ejerciciosdia, $muscs, $BD, 2, $arrayaux, $stringaux);
            if ($i == 1) $dia1 = $arrayaux; 
            else if ($i == 2) $dia2 = $arrayaux;
            else $dia3 = $arrayaux;
        }
        else {
            llenar_array($cont, $ejerciciosdia, $muscs, $BD, 3, $arrayaux, $stringaux);
            if($i == 4) $dia4 = $arrayaux; 
            else $dia5 = $arrayaux;
        }
        $string .= $stringaux;
        if ($i < $dias) $string .= " - ";
    }
    
}
else {
    $string = $fila["rutina"];
    echo "<br>";
    $stringauxiliar = $string;
    for($i = 1; $i < $dias+1; $i++){
        if ($dias == 3) $ejerciciostotales = $ejerciciosdia * 2;
        else if ($dias == 5)  $ejerciciostotales = $ejerciciosdia * 3;
        fill_frombd($dest, $string, $ejerciciostotales);
        if ($i == 1) $dia1 = $dest; 
        else if ($i == 2) $dia2 = $dest;
        else if ($i == 3) $dia3 = $dest;
        else if ($i == 4) $dia4 = $dest;
        else $dia5 = $dest;
    }
    $string = $stringauxiliar;
}

$query = "UPDATE planificacion SET planificacion.rutina = '$string', planificacion.nivel = '$nivel', planificacion.dias = $dias,  planificacion.eobjetivo = $objetivo
        WHERE planificacion.id_usuario = '$_SESSION[id_usuario]'";
    mysqli_query($BD, $query);

// Desconectar de la base de datos
mysqli_close($BD);

?>

<?php

// ~~~~~~~~~~~ FUNCIONES AUXILIARES ~~~~~~~~~~~
/**
 * Conecta con la base de datos
 * 
 * @param string $host lugar donde esta alojada.
 * @param string $user usuario de la BD.
 * @param string $pass contraseña de la BD.
 * @param string $DB_name nombre de la BD.
 * 
 * @return mysqli|null Devuelve la base de datos si existe o null en otro caso.
 */
function conectar_bd($host, $user, $pass, $DB_name) {
    $DB = new mysqli($host, $user, $pass, $DB_name);
    if ($DB->connect_errno) {
        error_log("Error de conexión a la BD: ({$conn->connect_errno }) {$conn->connect_error}");
        paginaError(502, 'Error', 'Oops', 'No ha sido posible conectarse a la base de datos.');
        return null;
    }
    if (!$DB->set_charset("utf8mb4")) {
        error_log("Error al configurar la codificación de la BD: ({$conn->errno }) {$conn->error}");
        paginaError(502, 'Error', 'Oops', 'No ha sido posible configurar la base de datos.');
        return null;
    }
    return $DB;
}
// Funcion que rellena los arrays de cada dia
function llenar_array(&$cont, $ejerciciosdia, $muscs, $BD, $nveces , &$arrayaux, &$stringaux) {
    for ($i = 0; $i < $nveces; $i++){
        $j = 0;
        $consulta = mysqli_query($BD,"SELECT * FROM ejercicios WHERE Musculo = '$muscs[$cont]'"); 
        while ($fila = mysqli_fetch_assoc($consulta)){
            if($j < $ejerciciosdia){
                array_push($arrayaux, $fila['Nombre']); 
                if($j+1 == $ejerciciosdia && $i+1 == $nveces) $stringaux .= $fila['Nombre'];
                else {
                    $stringaux .= $fila['Nombre'];
                    $stringaux .= " | ";
                }
            } 
            $j++;
        }
        $cont++;
    } 
}
// Funcion que rellena arrays desde la BD
function fill_frombd(&$dest, &$string, $ejerciciostotales){
    $auxiliar = explode(" - ", $string);
    $nuevostring = "";
    for($i = 1; $i < sizeof($auxiliar); $i++){
        $nuevostring .= $auxiliar[$i];
        if($i < sizeof($auxiliar)-1) $nuevostring .= " - ";
    }
    $dest = explode(" | ", $auxiliar[0], $ejerciciostotales);
    $string = $nuevostring;
}

/**
 * Muestra una tabla con el contenido de la BD
 * 
 * @param int $ejerciciosdia numero de ejercicios por cada dia.
 * @param int $dias numero de deias.
 * @param array $dia1
 * @param array $dia2
 * @param array $dia2
 * @param array $dia2
 */
function muestra_tabla($ejerciciosdia, $dias, $dia1, $dia2, $dia3, $dia4, $dia5) {
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
                default: break;
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
        <link rel="stylesheet" type="text/css" href="../../css/estiloaux4.css" />

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
                <div id="routine-table">
                <?php 
                    muestra_tabla($ejerciciosdia, $dias, $dia1, $dia2, $dia3, $dia4, $dia5);
                ?>
                </div>
                <div id="routine-info">
                    <p>Numero de repeticiones por ejercicio:
                    <?php
                        switch ($objetivo) {
                            case 1: echo "6.";  break;
                            case 2: echo "10."; break;
                            case 3: echo "16."; break;
                            default: break;
                        }
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