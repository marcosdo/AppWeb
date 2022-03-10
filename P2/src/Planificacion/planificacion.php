<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="../../resources/CSS/estiloaux.css" />

        <title>Planificación</title>

        <?php?>
    </head>
    <body>
        <div id="contenedor">
            <?php 
                require '../layout/cabecera.php'; 
                require '../layout/menu.php';
            ?>
            <?php
                /*session_start();*/
				function conectar ($host, $usuario, $contraseña,$nombreBD){
					$mysqli = new mysqli($host,$usuario,$contraseña,$nombreBD);
					if ($mysqli->connect_errno) {
						echo "ERROR Conexion";
					}
					return $mysqli;     
                }
                $BD = conectar("localhost","root","","practica 2 aw");
                $consulta = mysqli_query($BD,"SELECT * FROM ejercicios"); 
                
                /*while($BDLogros =  mysqli_fetch_array($consulta)){
                    echo $BDLogros["Musculo"] ;
                    echo $BDLogros["Nombre"];
                }*/
               /* if(isset($_POST['quitarLogro'])){
                    include  'planificaciontablas.php';
                    
                }
                echo " <input type='submit' style = 'background-color:#c47e7e' class = 'selectA' name='quitarLogro' value='Quitar Logro'/>";*/
				
               /* INSERT INTO usuario (nif, nombre, direccion, email, telefono)
                VALUES ("M3885337J", "Empresa Uno", "Calle Uno, Madrid",
                "jefe@empresauno.com", "91 2347898");*/
            ?> 
            <main>
                <h1 id = "TituloPlanificacion">¿Cuál es tu planificación ideal?</h1>
                <div id="tabla">
                    <fieldset> 
                        <legend id = "DietasPlanificacion">Dietas</legend>
                        <form method="post">
                        <p>
                            <select name="Elige tu dieta">
                                <option selected value="0"> Elige una opción </option>
                                <option value="1">Pérdida de peso</option> 
                                <option value="2">Ganancia de peso</option> 
                                <option value="3">Mantener peso</option>
                            </select>
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            Quisque rutrum sit amet ipsum sed mollis. Praesent lectus 
                            elit, pretium at condimentum in, elementum vitae lorem. 
                            Quisque eget vulputate nunc. Donec lobortis at justo in 
                            ornare. Duis lobortis magna justo, in finibus ipsum 
                            ultricies nec. Donec efficitur purus quis venenatis 
                            interdum. Aliquam cursus accumsan lacus, eget commodo nisi 
                            blandit nec. Sed vitae maximus elit. Cras commodo magna 
                            tortor, ut lobortis magna iaculis eget. 
                        </p>
                    </fieldset>
                    <form method = "post" action = "planificaciontablas.php">

                    <fieldset> 
                        <legend id = "RutinasPlanificacion">Rutinas</legend>
                        <p> Selecciona tu nivel: </p>
                        <p>
                            <input type= "radio" name="nivel" value="P">Principiante
                            <input type= "radio" name="nivel" value="M">Medio
                            <input type= "radio" name="nivel" value="A">Avanzada
                        </p>
                        <p>
                            <select name="Elige tu rutina">
                                <option selected value="0"> Elige una opción</option>
                                <option value="1">Fuerza</option>
                                <option value="2">Hipertrofia</option>
                                <option value="3">Resistencia</option>
                            </select>
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            Quisque rutrum sit amet ipsum sed mollis. Praesent lectus 
                            elit, pretium at condimentum in, elementum vitae lorem. 
                            Quisque eget vulputate nunc. Donec lobortis at justo in 
                            ornare. Duis lobortis magna justo, in finibus ipsum 
                            ultricies nec. Donec efficitur purus quis venenatis 
                            interdum. Aliquam cursus accumsan lacus, eget commodo nisi 
                            blandit nec. Sed vitae maximus elit. Cras commodo magna 
                            tortor, ut lobortis magna iaculis eget. 
                        </p>
                        <p>
                            <input type="submit" value = "Enviarrr">
                        </p>

                    </fieldset>
                    </form>
                </div>
            </main>
            <?php 
                require '../layout/anuncios.php';
                require '../layout/pie.php';
            ?>
        </div>
    </body>
</html>