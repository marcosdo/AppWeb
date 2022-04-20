<?php


use appweb\plan\Rutina;
use appweb\plan\Dieta;

/**
 * Metodo que devuelve una tabla con el contenido de las rutinas de la base de datos
 * @return html Código en html de una tabla
*/
function mostrarRutina(){
    
    $obj = 10;
    $arrayreps = [];
    $arrayaux = Rutina::buscaRutina($obj, $arrayreps, $_SESSION['id']);
    if($obj != 10) {
        // DIA 1 A 3 MISMOS EJERCICIOS DIA 4 A 5 MAS EJERCICIOS
        $ejerciciostotales = count($arrayaux [count($arrayaux)-1]); 
        $contenido = "<caption>Rutina de entrenamiento</caption><thead><tr>";

        // num. de dias
        for ($i = 1; $i < count($arrayaux)+1;$i++) { 
            $contenido .= "<th>Día $i </th>";
        }

        $contenido .= "</tr></thead><tbody>";
        for ($i = 0; $i < $ejerciciostotales;$i++){
            $contenido .= "<tr>";
            // num. de ejercicios al cabo del día
            for ($j = 0; $j < count($arrayaux); $j++) {
                // DIA 4 Y 5 HASTA 6 Y DIA 1 A 3 HASTA 4 EN NIVEL PRINCIPIANTE :)
                $auxiliar = isset($arrayaux[$j][$i]) ? $arrayaux[$j][$i] : ""; 
                if (isset($arrayaux[$j][$i])) 
                    $auxiliar .= " x ";
                $auxiliar .= isset($arrayreps[$j][$i])  ? $arrayreps[$j][$i] : "";
                $contenido .= "<td> $auxiliar</td>";
            }
            $contenido .= "</tr>";
        }
        $series = "</tbody><div id= repeticiones>";
        $series .= "<p> Nº de series: 3 </p> </div>";

        $html = <<<EOF
            <table id=planificacion>$contenido</table>
            $series
        EOF;
    }
    else{
        $contenido = "No hay ninguna rutina creada";
        $html = <<<EOF
            $contenido
        EOF;
    }
    return $html;
}

/**
 * Metodo que devuelve una tabla con el contenido de las comidas de la base de datos
 * La tabla tiene una columna por dia de la semana, y dos filas por cada comida { desayuno, comida, cena }
 * @return html
*/
function mostrarDieta(){
    $dias = 0;
    $desayuno = array();
    $almuerzo = array();
    $cena = array();
    $fecha = Dieta:: buscaDieta($_SESSION['id'], $dias, $desayuno, $almuerzo, $cena);

    $contenido = "<table id=planificacion>";
    $contenido .= "<caption>Planificacion de tu dieta</caption>";
    $contenido .= "<thead><tr>";
    // Dias de la semana 
    $contenido .= "<th></th>";
    for ($i = 0; $i < $dias; $i++) { 
        $dia_semana = date('w', strtotime($fecha));
        $dia_mes = date('d', strtotime($fecha));
        switch ($dia_semana) {
            case 1: { $contenido .= "<th>L ".$dia_mes."</th>";   } break;
            case 2: { $contenido .= "<th>M ".$dia_mes."</th>";   } break;
            case 3: { $contenido .= "<th>X ".$dia_mes."</th>";   } break;
            case 4: { $contenido .= "<th>J ".$dia_mes."</th>";   } break;
            case 5: { $contenido .= "<th>V ".$dia_mes."</th>";   } break;
            case 6: { $contenido .= "<th>S ".$dia_mes."</th>";   } break;
            case 0: { $contenido .= "<th>D ".$dia_mes."</th>";   } break;
            default: break;
        }
        $fecha = date('Y-m-d', strtotime($fecha . '+1 day'));
    }
    $contenido .= "</tr></thead><tbody>";
    for ($i = 0; $i < 3; $i++) {
        $contenido .= "<tr>";
        switch ($i) {
            case 0: $contenido .= "<td id=\"table-diets\">Desayuno</td>";  break;
            case 1: $contenido .= "<td id=\"table-diets\">Comida</td>";    break;
            case 2: $contenido .= "<td id=\"table-diets\">Cena</td>";      break;
            default: break;
        }
        for ($j = 0; $j < $dias; $j++) {
            switch ($i) {
                case 0: $contenido .= "<td>" . $desayuno[$j] . "</td>";   break;
                case 1: $contenido .= "<td>" . $almuerzo[$j] . "</td>";     break;
                case 2: $contenido .= "<td>" . $cena[$j] . "</td>";       break;
                default: break;
            }
        }
        $contenido .= "</tr>";
    }
    $contenido .= "</tbody></table>";
    $html = <<<EOF
    $contenido
    EOF;

    return $html;

}