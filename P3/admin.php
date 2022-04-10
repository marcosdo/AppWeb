<?php

require_once __DIR__.'/includes/config.php';


$tituloPagina = 'Consola';
$contenidoPrincipal = <<<EOS
<h1>Consola de Administracion</h1>
<div id="consola">
    <ul>
        <li><a href='admincrea.php'>Crea un nuevo usuario</a></li>
    </ul>
</div>
EOS;
require __DIR__.'/includes/vistas/plantillas/plantilla.php';