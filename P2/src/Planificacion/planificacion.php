<?php session_start(); ?>

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
                <h1 id="title-plan">¿Cuál es tu planificación ideal?</h1>
                <div id="select-plan">
                    <fieldset> 
                        <legend id="diet-plan">Dietas</legend>
                        <form method="post" action="planificaciondietas.php">
                        <p>
                            <select name="dieta" id="choose-diet">
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
                        <p>
                            <input type="submit" name="enviar" value="Quiero esta dieta" class="send-button">
                        </p>
                        </form>
                    </fieldset>

                    <fieldset> 
                        <legend id="routine-plan">Rutinas</legend>
                        <form method="post" action="planificacionrutinas.php">
                        <p> Selecciona tu nivel: </p>
                        <p>
                            <input type= "radio" name="nivel" value="P" checked>Principiante
                            <input type= "radio" name="nivel" value="M">Medio
                            <input type= "radio" name="nivel" value="A">Avanzada
                        </p>
                        <p>
                            <select name="dias" id="choose-days">
                                <option value="3">3 Días</option>
                                <option value="5">5 Días</option>
                            </select >
                        </p>
                        <p>
                            <select name="rutina" id="choose-routine">
                                <option value="1">Fuerza</option>
                                <option value="2">Hipertrofia</option>
                                <option value="3">Resistencia</option>
                            </select >
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
                            <input type="submit" name="enviar" value ="Quiero esta rutina" class="send-button">
                        </p>
                        </form>
                    </fieldset>
                </div>
            </main>
            <?php 
                require '../includes/vistas/anuncios.php';
                require '../includes/vistas/pie.php';
            ?>
        </div>
    </body>
</html>