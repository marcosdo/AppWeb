<?php

require_once __DIR__.'/includes/config.php';


$tituloPagina = 'Consola';
$contenidoPrincipal = <<<EOS
<h1>Consola de Administracion</h1>
<div id="consola">
    <ul>
        <li><a href='adminusuarios.php'>Operaciones sobre usuarios</a></li>
        <li><a href='adminanuncios.php'>Operaciones sobre anuncios</a></li>
    </ul>
</div>
EOS;
require __DIR__.'/includes/vistas/plantillas/plantilla.php';