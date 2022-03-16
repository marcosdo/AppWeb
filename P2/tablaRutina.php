<?php

require_once __DIR__.'/includes/config.php';

$tabla = new es\ucm\fdi\aw\Rutina();
$htmlRutina = $tabla->mostrar();

$tituloPagina = 'Rutina';

$contenidoPrincipal = <<<EOS
<h1>Rutina de entrenamiento</h1>
$htmlRutina
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';