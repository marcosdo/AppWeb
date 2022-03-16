<?php session_start(); ?>

<?php
// Coger los datos del formulario
// dieta = int: [1, 2, 3] 1-->Perdida de peso. 2-->Ganancia de peso. 3--> Mantener el peso.
htmlspecialchars(trim(strip_tags($_POST["dieta"])));
// Si los datos existen los mete en variables
$objetivo = isset($_POST["dieta"]) ? $_POST["dieta"] : null;

/* ===============================
SI LOS DATOS NO EXISTEN ERROR AQUI
=============================== */

// Conenctar con la base de datos
$BD = conectar_bd("localhost","root","","lifety");

/* ====================================
SI LA BASE DE DATOS NO EXISTE ERROR AQUI
===================================== */

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

$des = "";
$coms = "";
$cens = "";

$sqlselect = "SELECT * FROM planificacion WHERE planificacion.Id_usuario = '$_SESSION[id_usuario]'";

$resultado = $BD->query($sqlselect); 
$fila = mysqli_fetch_assoc($resultado);
if(is_null($fila["Dobjetivo"]) || $fila["Dobjetivo"] != $objetivo || is_null($fila["desayunos"]) || is_null($fila["comidas"]) || is_null($fila["cenas"])){ // Nueva tabla
    // Rellena los arrays con comidas aleatorias   
    fill_random($desayunos, $desayunos_aux, $des);
    fill_random($comidas, $comidas_aux, $coms);
    fill_random($cenas, $cenas_aux, $cens);

    $query = "UPDATE planificacion SET planificacion.desayunos = '$des', planificacion.comidas = '$coms', 
    planificacion.cenas = '$cens' WHERE planificacion.Id_usuario = '$_SESSION[id_usuario]'";
    mysqli_query($BD, $query);

}

else {
    $des = $fila["desayunos"];
    $coms = $fila["comidas"];
    $cens = $fila["cenas"];

    fill_frombd($desayunos, $des);
    fill_frombd($comidas, $coms);
    fill_frombd($cenas, $cens);
}

$query = "UPDATE planificacion SET planificacion.Dobjetivo = $objetivo WHERE planificacion.Id_usuario = '$_SESSION[id_usuario]'";
mysqli_query($BD, $query);

?>

<?php

// ~~~~~~~~~~~ FUNCIONES AUXILIARES ~~~~~~~~~~~
function fill_array(&$dest, $tipo, $objetivo, $BD) {
    // Consulta que te devuelve el numero de elementos que hay de ese tipo 
    $consulta = mysqli_query($BD, "SELECT dietas.descripcion FROM dietas WHERE dietas.Tipo = '$tipo' AND dietas.Objetivo = $objetivo"); 
    while ($fila = mysqli_fetch_assoc($consulta)){
        array_push($dest, $fila['descripcion']);
    }
}

// Inserta siete (7) elementos en el array destino
function fill_random(&$dest, $src, &$string) {
    // Si esta vacio no hace nada
    if (empty($src)) {
        return;
    }
    // Por cada dia de la semana
    for ($i = 0; $i < 7; $i++) {
        $clave = array_rand($src, 1); 
        $dest[] =  $src[$clave];
        $string .= $src[$clave];
        if($i != 6) $string .=  " | ";
    }
}

function fill_frombd(&$dest, $string){
    $dest = explode(" | ", $string);
}

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
        error_log("Error de conexión a la BD: ({$DB->connect_errno }) {$DB->connect_error}");
        //paginaError(502, 'Error', 'Oops', 'No ha sido posible conectarse a la base de datos.');
        return null;
    }
    if (!$DB->set_charset("utf8mb4")) {
        error_log("Error al configurar la codificación de la BD: ({$DB->errno }) {$DB->error}");
        //paginaError(502, 'Error', 'Oops', 'No ha sido posible configurar la base de datos.');
        return null;
    }
    return $DB;
}

// Funcion que muestra la tabla
function muestra_tabla($desayunos, $comidas, $cenas) {
    echo "<table id=\"tabla-dietas\">";
    echo "<caption>Planificacion de tu dieta:</caption>";
    echo "<tr>";
    // Dias de la semana 
    for ($i = 0; $i < 7; $i++) { 
        switch ($i) {
            case 0: { echo "<th>LUNES</th>";    } break;
            case 1: { echo "<th>MARTES</th>";   } break;
            case 2: { echo "<th>MIÉRCOLES</th>";} break;
            case 3: { echo "<th>JUEVES</th>";   } break;
            case 4: { echo "<th>VIERNES</th>";  } break;
            case 5: { echo "<th>SÁBADO</th>";   } break;
            case 6: { echo "<th>DOMINGO</th>";  } break;
            default: break;
        }
    }
  
    echo "</tr>";
    
    for ($j = 0; $j < 6; $j++) {
        echo "<tr>";
        if (($j % 2) != 0) {
            for ($i = 0; $i < 7; $i++) {
                switch ($j) {
                    case 1: print "<td>$desayunos[$i] </td>";   break;
                    case 3: print "<td>$comidas[$i] </td>";     break;
                    case 5: print "<td>$cenas[$i] </td>";       break;
                    default: break;
                }
            }
       }
       else  {
            switch ($j) {
                case 0: echo "<td colspan=\"7\" id=\"table-diets\">Desayuno</td>";  break;
                case 2: echo "<td colspan=\"7\" id=\"table-diets\">Comida</td>";    break;
                case 4: echo "<td colspan=\"7\" id=\"table-diets\">Cena</td>";      break;
                default: break;
            }
        }
        echo "</tr>";
    }
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
    </head>
    <body>
        <div id="contenedor">
            <?php 
                require '../includes/vistas/cabecera.php'; 
                require '../includes/vistas/menu.php';
            ?>
            <main>
                <div id="diet-table">
                    <?php muestra_tabla($desayunos, $comidas, $cenas); ?>
                </div>
            </main>
            <?php 
                require '../includes/vistas/anuncios.php';
                require '../includes/vistas/pie.php';
            ?>
        </div>
    </body>
</html>