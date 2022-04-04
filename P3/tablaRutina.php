<?php

require_once __DIR__.'/includes/config.php';

$plani = new es\ucm\fdi\aw\Planificacion();
$htmlRutina = $plani->mostrar();
$tituloPagina = 'Rutina';
$contenidoPrincipal = <<<EOS
$htmlRutina
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';