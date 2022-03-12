<?php
    session_start();
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
                require '../layout/cabecera.php'; 
                require '../layout/menu.php';
            ?>
            <main>
           
                <?php

				function conectar ($host, $usuario, $contraseña,$nombreBD){
					$mysqli = new mysqli($host,$usuario,$contraseña,$nombreBD);
					if ($mysqli->connect_errno) {
						echo "ERROR Conexion";
					}
					return $mysqli;     
                }
                $BD = conectar("localhost","root","","practica 2 aw");
               

                htmlspecialchars(trim(strip_tags($_POST["nivel"])));
                htmlspecialchars(trim(strip_tags($_POST["Rutina"])));
                htmlspecialchars(trim(strip_tags($_POST["Dias"])));

                $nivel = isset($_POST["nivel"]) ? $_POST["nivel"] : null;
                $objetivo = isset($_POST["Rutina"]) ? $_POST["Rutina"] : null;
                $dias = isset($_POST["Dias"]) ? $_POST["Dias"] : null;
                $consulta = mysqli_query($BD,"SELECT * FROM usuario");
                $fila = mysqli_fetch_assoc($consulta);
                $sql = "UPDATE usuario SET Nivel = '$nivel', Dias = '$dias',  Eobjetivo = '$objetivo' WHERE Nombre = '$fila[Nombre]'";

                 // -->Nivel principiante: 2 +2
                 // -->Nivel medio: 3 +3
                 // -->Nivel avanzado:4 + 4
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
           $arraydia1 = array();
         /*  $contador_musculo = 1;
           echo "<table>";
           echo "<tr>";
           for( $dia_actual = 1; $dia_actual <= $dias; $dia_actual++){
               echo "<td> Dia $dia_actual:  </td>";
           }
           echo "</tr>";
           if($dias == 3) $aux = $ejerciciosdia*2;
           else if ($dias == 5)  $aux = $ejerciciosdia*3;
           for($i = 0; $i < $aux; $i++){
               echo "<tr>";
               for($dia_actual = 1; $dia_actual <= $dias; $dia_actual++){
                echo "<td>";
                switch($dia_actual){
                    case 1:
                        if($dias == 5 && $i >= ($ejerciciosdia*2)) break;
                        if($i == $ejerciciosdia) $contador_musculo = 2;
                        else $contador_musculo = 1;
                        mostrar($contador_musculo,$muscs, $BD);

                    break;
                    case 2:
                        if($dias == 5 && $i >= ($ejerciciosdia*2)) break;
                        if($i == $ejerciciosdia) $contador_musculo = 3; 
                        else $contador_musculo = 4;
                        mostrar($contador_musculo,$muscs, $BD);
                    break;
                    case 3: 
                        if($dias == 5 && $i >= ($ejerciciosdia*2)) break;
                        if($i == $ejerciciosdia) $contador_musculo = 6;
                        else $contador_musculo = 5;
                        mostrar($contador_musculo,$muscs, $BD);
                    break;
                    case 4:
                        if($i == $ejerciciosdia) $contador_musculo = 2;
                        else if ($i == $ejerciciosdia*2) $contador_musculo = 3;
                        else $contador_musculo = 1;
                        mostrar($contador_musculo,$muscs, $BD);
                    break; 
                    case 5:
                        if($i == $ejerciciosdia) $contador_musculo = 5;
                        else if ($i == $ejerciciosdia*2) $contador_musculo = 6;
                        else $contador_musculo = 4;
                        mostrar($contador_musculo,$muscs, $BD);
                    break;
                    }
                    echo "</td>";
                }
                echo "</tr>";
           }
           function mostrar($cont, $muscs, $BD){
                    $consulta = mysqli_query($BD,"SELECT * FROM ejercicios WHERE Musculo = '$muscs[$cont]'");
                    $fila = mysqli_fetch_assoc($consulta);
                    echo  $fila['Nombre']; 
            }
             $cont = 1;
            echo "<table>";
            for($i = 1; $i < $dias +1; $i++){
                echo "<tr>";
                echo "<td> Dia $i:  </td>";
                if($i == 4) {
                    $cont = 1;
                    $ejerciciosdia--;
                }
                if($i >= 1 && $i <= 3) mostrar($cont, $ejerciciosdia, $muscs, $BD, 2);
                else mostrar($cont, $ejerciciosdia, $muscs, $BD, 3);
                echo "</tr>";
            }
            echo "</table>";

            function mostrar(&$cont, $ejerciciosdia, $muscs, $BD, $nveces){
                for($i = 0; $i < $nveces; $i++){
                    $j = 0;
                    $consulta = mysqli_query($BD,"SELECT * FROM ejercicios WHERE Musculo = '$muscs[$cont]'");
                    while ($fila = mysqli_fetch_assoc($consulta)){
                        if($j < $ejerciciosdia) echo "<td> $fila[Nombre]</td>";  
                        $j++;
                    }
                    $cont++;
                 } 
            }
            */
           
            $cont = 1;
            $arraydias = array (
                0 => array(), 
                1 => array(),
                2 => array(), 
                3 => array(),
                4 => array()
              );
            for($i = 1; $i < $dias +1; $i++){
                $arrayaux = array();
                
                if($i == 4) {
                    $cont = 1;
                    $ejerciciosdia--;
                }
                if($i >= 1 && $i <= 3) rellenar($cont, $ejerciciosdia, $muscs, $BD, 2, $arrayaux);
                else rellenar($cont, $ejerciciosdia, $muscs, $BD, 3, $arrayaux);
                array_push($arraydias[$i], $arrayaux);
            }
           

              //echo $cars[0][0].": In stock: ".$cars[0][1].", sold: ".$cars[0][2].".<br>";
        
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
            
            if($dias == 3) $aux = $ejerciciosdia*2;
            else if ($dias == 5)  $aux = $ejerciciosdia*3;
            echo "<table>";
            echo "<tr>";
            for( $dia_actual = 1; $dia_actual <= $dias; $dia_actual++){
                echo "<td> Dia $dia_actual:  </td>";
            }
            /*foreach ($arraydias as $i => $valor) {
                foreach ($valor as $desc) {
                    print "el pais es $i, la moneda  descr $desc.<br />\n";
                }
             }*/
             
             
    foreach ($dias as $arraydias => $valor) {
        echo "El almuno tiene $arraydias: ".$valor[0]."</br>";
        echo "El almuno tiene $arraydias: ".$valor[1]."</br>";
        echo "El almuno tiene $arraydias: ".$valor[2]."</br>";
        }

            echo "</tr>";
            
            for ($i = 0; $i < $dias; $i++){
                echo "<tr>";
                
                for($j = 0; $j < $aux; $j++){
                  print "<td> $arraydias[$i][$j]  </td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            ?>
           
            </main>
            <?php 
                require '../layout/anuncios.php';
                require '../layout/pie.php';
            ?>
        </div>
    </body>
</html>