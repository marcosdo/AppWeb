<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/ayudasmostrar.php';


$htmlRutina = mostarRutina();
$tituloPagina = 'Rutina';

$contenidoPrincipal = <<<EOS
$htmlRutina
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';