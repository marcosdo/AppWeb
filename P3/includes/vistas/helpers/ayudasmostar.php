<?php
use es\ucm\fdi\aw\Rutina;

function mostrarRutina(){
    
    $obj = 0;
    $arrayreps = [];
    $arrayaux = Rutina::buscaRutina($obj, $arrayreps);
    $ejerciciostotales = count($arrayaux [count($arrayaux)-1]); // DIA 1 A 3 MISMOS EJERCICIOS DIA 4 A 5 MAS EJERCICIOS
    $contenido = "<caption>Rutina de entrenamiento</caption><thead><tr>";


    for ($i = 1; $i < count($arrayaux)+1;$i++){ //nº de dias
        $contenido .= "<th>Día $i </th>";
    }
    $contenido .= "</tr></thead><tbody>";
    for ($i = 0; $i < $ejerciciostotales;$i++){
        $contenido .= "<tr>";
        for ($j = 0; $j < count($arrayaux); $j++) { //nº de ejercicios al cabo del día
            $auxiliar = isset($arrayaux[$j][$i]) ? $arrayaux[$j][$i] : ""; //DIA 4 Y 5 HASTA 6 Y DIA 1 A 3 HASTA 4 EN NIVEL PRINCIPIANTE :)
            if(isset($arrayaux[$j][$i])) $auxiliar .= " x ";
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
    return $html;

}


