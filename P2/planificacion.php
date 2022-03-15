<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Pago nutricionista';

$contenidoPrincipal = <<<EOS
<h1 id="title-plan">¿Cuál es tu planificación ideal?</h1>
    <div id="tabla">
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
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';