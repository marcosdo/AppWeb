<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Pago nutricionista';

$contenidoPrincipal = <<<EOS
<h1>Registro de usuario</h1>
<div id="tabla">
    <form method="POST" action="pago.php">
        <fieldset>
            <legend> Por favor, introduzca sus datos:</legend>
            Peso:<br><input type="text" name="peso" required/><br>
            Altura:<br><input type="text" name="altura" required/><br>
            Alergias:<br><input type="text" name="alergias"/><br>
            Observaciones adicionales:<br><input type="text" name="observaciones"/><br>
            <br><input type="submit" value="Pagar" /></br>
        </fieldset>
    </form>
    <img src="RUTA_IMGS/nutricionista.jpg" alt="Tu nutri de confianza" >
</div>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';