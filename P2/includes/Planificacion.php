<?php
namespace es\ucm\fdi\aw;

class Planificacion {

    public function __construct() {}
    public function mostrar(){
        $BD = Aplicacion::getInstance()->getConexionBd();
        $sqlselect = sprintf("SELECT * FROM planificacion WHERE planificacion.id_usuario = '%s'", $_SESSION['id']);
        $resultado = $BD->query($sqlselect); 
        $fila = $resultado->fetch_assoc();
        $arrayaux = json_decode($fila['rutina']);
        $ejerciciostotales = count($arrayaux [count($arrayaux)-1]); // DIA 1 A 3 MISMOS EJERCICIOS DIA 4 A 5 MAS EJERCICIOS
        //eof :)))))))))))))
        $contenido = "<caption>Rutina de entrenamiento:</caption><tr>";
        for ($i = 0; $i < count($arrayaux);$i++){ //nº de dias
            $contenido .= "<th>Día $i</th>";
        }
        $contenido .= "</tr>";
        for ($i = 0; $i < $ejerciciostotales;$i++){
            $contenido .= "<tr>";
            for ($j = 0; $j < count($arrayaux); $j++) { //nº de ejercicios al cabo del día
                $auxiliar = isset($arrayaux[$j][$i]) ? $arrayaux[$j][$i] : ""; //DIA 4 Y 5 HASTA 6 Y DIA 1 A 3 HASTA 4 EN NIVEL PRINCIPIANTE :)
                $contenido .= "<td> $auxiliar</td>";
            }
            $contenido .= "</tr>";
        }
        //$contenido .= "</table>";
        $html = <<<EOF
        <table>$contenido</table>
        EOF;
    }
}
