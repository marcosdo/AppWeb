<?php
namespace es\ucm\fdi\aw;

class Planificacion {
/*
Repeticiones por musculo
    -->Fuerza:6
    -->Hipertrofia: 10
    -->Resistencia: 16
Nº series: 3
 */
    public function __construct() {}
    public function mostrar(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM rutina WHERE rutina.id_usuario = '%d', rutina.activa = '%d'", $_SESSION['id'], 1);
        $rs = $conn->query($query); 
        $fila = $rs->fetch_assoc();
        $objetivo = $fila['objetivo'];
        $rutinaid = $fila['id_rutina'];
        $query = sprintf("SELECT * FROM contiene WHERE contiene.id_rutina = '%d'", $rutinaid);
        $rs = $conn->query($query); 
        $arrayaux = [];
        while($fila = $rs->fetch_assoc()){
        }

       // $arrayaux = json_decode($fila['rutina']);
        $rs->free();
        $ejerciciostotales = count($arrayaux [count($arrayaux)-1]); // DIA 1 A 3 MISMOS EJERCICIOS DIA 4 A 5 MAS EJERCICIOS
        $contenido = "<caption>Rutina de entrenamiento:</caption><tr>";
        for ($i = 1; $i < count($arrayaux)+1;$i++){ //nº de dias
            $contenido .= "<th>Día $i </th>";
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
        if($objetivo == 1){
            $repeticiones = "Nº de repeticiones = 6.  ";
        }else if($objetivo == 2){
            $repeticiones = "Nº de repeticiones = 10.  ";
        }
        else{
            $repeticiones = "Nº de repeticiones = 16.  ";
        }
        $repeticiones .= "Nº de series: 3";
        $html = <<<EOF
        <table>$contenido</table>
        $repeticiones
        EOF;
        return $html;
    }
}
