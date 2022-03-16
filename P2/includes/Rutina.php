<?php
namespace es\ucm\fdi\aw;

class Rutina {
    
    /** @var array Array con los ejercicios de cada dia **/
    private $_dia1;
    /** @var array Array con los ejercicios de cada dia **/
    private $_dia2;
    /** @var array Array con los ejercicios de cada dia **/
    private $_dia3;
    /** @var array Array con los ejercicios de cada dia **/
    private $_dia4;
    /** @var array Array con los ejercicios de cada dia **/
    private $_dia5;
    
    private $_rutinastring;
    private $_ejerciciosdia;
    private $_nivel;
    private $_objetivo;
    private $_id;
    private $_dias;
      
    private $_muscs;
    

    public static function comprobarRutina($id, $objetivo, $nivel, $dias) { 
        $BD = Aplicacion::getInstance()->getConnectionBd();

        $sqlselect = "SELECT * FROM planificacion WHERE planificacion.id_usuario = '$id'";
        $resultado = $BD->query($sqlselect); 
        $fila = mysqli_fetch_assoc($resultado);
        
        if (is_null($fila["dias"]) || $dias != $fila["dias"] || is_null($fila["nivel"]) || $nivel != $fila["nivel"]
            || is_null($fila["eobjetivo"]) || $fila["eobjetivo"] != $objetivo){  //cuando no existe rutina o ha cambiado parametros
            crearRutina($id, $objetivo, $nivel, $dias); 
        }
        
        else { //cuando existe rutina
            cargarRutina($fila);
        }
        mostrar();
    }

    private function cargarRutina(){
        $_rutinastring = $fila["rutina"];
        $stringauxiliar = $_rutinastr;
        for($i = 1; $i < $_dias+1; $i++){
            if ($_dias == 3) $ejerciciostotales = $_ejerciciosdia * 2;
            else if ($_dias == 5)  $ejerciciostotales = $_ejerciciosdia * 3;
            fill_frombd($dest, $string, $ejerciciostotales);
            if ($i == 1) $_dia1 = $dest; 
            else if ($i == 2) $_dia2 = $dest;
            else if ($i == 3) $_dia3 = $dest;
            else if ($i == 4) $_dia4 = $dest;
            else $_dia5 = $dest;
        }
        $_rutinastring = $stringauxiliar;
    }


    private function crearRutina ($id, $objetivo, $nivel, $dias){
        $rutina = new Rutina($id, $objetivo, $nivel, $dias);
        $cont = 1;  
        for ($i = 1; $i < $_dias +1; $i++) {
            $arrayaux = array();
            $stringaux = "";
    
            if ($i == 4) $cont = 1;
            if ($i >= 1 && $i <= 3) {
                fill_array($cont, 2, $arrayaux, $stringaux);
                if ($i == 1) $_dia1 = $arrayaux; 
                else if ($i == 2) $_dia2 = $arrayaux;
                else $_dia3 = $arrayaux;
            }
            else {
                fill_array($cont, 3, $arrayaux, $stringaux);
                if($i == 4) $_dia4 = $arrayaux; 
                else $_dia5 = $arrayaux;
            }
            $_rutinastring .= $stringaux;
            if ($i < $_dias) $_rutinastring .= " - ";
        }

        $query = "UPDATE planificacion SET planificacion.rutina = '$_rutinastring', planificacion.nivel = '$_nivel', planificacion.dias = $_dias,  planificacion.eobjetivo = $_objetivo
        WHERE planificacion.id_usuario = '$_id'";

    }

    private function mostrar(){
        if ($_dias == 3) 
            $ejerciciostotales = $_ejerciciosdia * 2;
        else if ($_dias == 5)  
            $ejerciciostotales = $_ejerciciosdia * 3;
        // Empieza la tabla
        echo "<table><caption>Rutina de entrenamiento:</caption><tr>";
        // Celdas con los dias
        for ($dia_actual = 1; $dia_actual <= $_dias; $dia_actual++){
            echo "<th>Día $dia_actual</th>";
            // Fin de linea
            echo "</tr>";
            // Por cada fila de ejercicios
            for ($i = 0; $i < $ejerciciostotales; $i++) {
                // Empieza una linea
                echo "<tr>";
                // Por cada fila
                for($j = 1; $j < $_dias + 1; $j++){
                    // Dependiendo del dia, mete su valor asociado
                    switch ($j) {
                        case 1:
                            if ($i < sizeof($_dia1))
                                print "<td> $_dia1[$i] </td>";
                            else echo "<td></td>";
                            break;
                        case 2:
                            if ($i < sizeof($_dia2))
                                print "<td> $_dia2[$i] </td>";
                            else echo "<td></td>";
                            break;
                        case 3:
                            if ($i < sizeof($_dia3))
                                print "<td> $_dia3[$i] </td>";
                            else echo "<td></td>";
                            break;
                        case 4:
                            if ($i < sizeof($_dia4))
                                print "<td> $_dia4[$i] </td>";
                            else echo "<td></td>";
                            break;
                        case 5:
                            if ($i < sizeof($_dia5))
                                print "<td> $_dia5[$i] </td>";
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

    }

    private function fill_arrray(&$cont, $nveces , &$arrayaux, &$stringaux) {
        $BD = Aplicacion::getInstance()->getConnectionBd();
        for ($i = 0; $i < $nveces; $i++){
            $j = 0;
            $consulta = mysqli_query($BD,"SELECT * FROM ejercicios WHERE musculo = '$_muscs[$cont]'"); 
            while ($fila = mysqli_fetch_assoc($consulta)){
                if($j < $_ejerciciosdia){
                    array_push($arrayaux, $fila['nombre']); 
                    if($j+1 == $_ejerciciosdia && $i+1 == $nveces) $stringaux .= $fila['nombre'];
                    else {
                        $stringaux .= $fila['nombre'];
                        $stringaux .= " | ";
                    }
                } 
                $j++;
            }
            $cont++;
        } 
    }

    private function fill_frombd(&$dest, &$string, $ejerciciostotales){
        $auxiliar = explode(" - ", $string);
        $nuevostring = "";
        for($i = 1; $i < sizeof($auxiliar); $i++){
            $nuevostring .= $auxiliar[$i];
            if($i < sizeof($auxiliar)-1) $nuevostring .= " - ";
        }
        $dest = explode(" | ", $auxiliar[0], $ejerciciostotales);
        $string = $nuevostring;
    }

    private function __construct($id, $objetivo, $nivel, $dias) {
        $_dia1 = array(); 
        $_dia2 = array(); 
        $_dia3 = array(); 
        $_dia4 = array();
        $_dia5 = array();
        $_nivel = $nivel;
        $_id = $id;
        $_objetivo = $objetivo;
        $_dias = $dias;
        $_rutinastring = "";
        switch ($nivel) {
            case "P": $_ejerciciosdia = 2; break;
            case "M": $_ejerciciosdia = 3; break;
            case "A": $_ejerciciosdia = 4; break;
        }
        $_muscs = array(
            1 => "Pecho",
            2 => "Hombro",
            3 => "Espalda",
            4 => "Biceps",
            5 => "Pierna",
            6 => "Triceps",
        );
    }

}
