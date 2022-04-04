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
        $query = sprintf("SELECT * FROM rutina WHERE rutina.id_usuario = '%d'", $_SESSION['id']);
        $rs = $conn->query($query); 
        while( $fila = $rs->fetch_assoc()){
            if($fila['activa'] == true){
                $objetivo = $fila['objetivo'];
                $rutinaid = $fila['id_rutina'];
            }
        }
        $q = sprintf("SELECT * FROM contiene WHERE contiene.id_rutina = '%d'", $rutinaid);
        $t = $conn->query($q); 
        $arrayaux = [];
        $dia1 = array();
        $dia2 = array();
        $dia3 = array();
        $dia4 = array();
        $dia5 = array();
    
        while($fila = $t->fetch_assoc()){
        
            if($fila['dia'] == 1){
                $c = sprintf("SELECT * FROM ejercicios WHERE ejercicios.id_ejercicio = '%d'", $fila['id_ejercicio']);
                $rs = $conn->query($c);
                $fila = $rs->fetch_assoc();
                array_push($dia1, $fila['nombre']);
            }
            else if ($fila['dia'] == 2){
                $c = sprintf("SELECT * FROM ejercicios WHERE ejercicios.id_ejercicio = '%d'", $fila['id_ejercicio']);
                $rs = $conn->query($c);
                $fila = $rs->fetch_assoc();
                array_push($dia2, $fila['nombre']);
            }
            else if ($fila['dia'] == 3){
                $c = sprintf("SELECT * FROM ejercicios WHERE ejercicios.id_ejercicio = '%d'", $fila['id_ejercicio']);
                $rs = $conn->query($c);
                $fila = $rs->fetch_assoc();
                array_push($dia3, $fila['nombre']);
            }
            else if ($fila['dia'] == 4){
                $c = sprintf("SELECT * FROM ejercicios WHERE ejercicios.id_ejercicio = '%d'", $fila['id_ejercicio']);
                $rs = $conn->query($c);
                $fila = $rs->fetch_assoc();
                array_push($dia4, $fila['nombre']);
            }
            else{
                $c = sprintf("SELECT * FROM ejercicios WHERE ejercicios.id_ejercicio = '%d'", $fila['id_ejercicio']);
                $rs = $conn->query($c);
                $fila = $rs->fetch_assoc();
                array_push($dia5, $fila['nombre']);
            }
        }
        if(!empty($dia1)) array_push($arrayaux, $dia1);
        if(!empty($dia2)) array_push($arrayaux, $dia2);
        if(!empty($dia3)) array_push($arrayaux, $dia3);
        if(!empty($dia4)) array_push($arrayaux, $dia4);
        if(!empty($dia5)) array_push($arrayaux, $dia5);

        $rs->free();
        $ejerciciostotales = count($arrayaux [count($arrayaux)-1]); // DIA 1 A 3 MISMOS EJERCICIOS DIA 4 A 5 MAS EJERCICIOS
        $contenido = "<caption>Rutina de entrenamiento:</caption><thead><tr>";


        for ($i = 1; $i < count($arrayaux)+1;$i++){ //nº de dias
            $contenido .= "<th>Día $i </th>";
        }
        $contenido .= "</tr></thead><tbody>";
        for ($i = 0; $i < $ejerciciostotales;$i++){
            $contenido .= "<tr>";
            for ($j = 0; $j < count($arrayaux); $j++) { //nº de ejercicios al cabo del día
                $auxiliar = isset($arrayaux[$j][$i]) ? $arrayaux[$j][$i] : ""; //DIA 4 Y 5 HASTA 6 Y DIA 1 A 3 HASTA 4 EN NIVEL PRINCIPIANTE :)
                $contenido .= "<td> $auxiliar</td>";
            }
            $contenido .= "</tr>";
        }
        $repeticiones = "</tbody><div id= repeticiones>";
        if($objetivo == 1){
            $repeticiones .= "<p> Nº de repeticiones = 6. </p>";
        }else if($objetivo == 2){
            $repeticiones .= "<p> Nº de repeticiones = 10. </p>";
        }
        else{
            $repeticiones .= "<p> Nº de repeticiones = 16. </p>";
        }
        $repeticiones .= "<p> Nº de series: 3 </p> </div>";
        $html = <<<EOF
        <table id=planificacion>$contenido</table>
        $repeticiones
        EOF;
        return $html;
    }
}
