<?php 

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/planes.php';

$htmlDieta = mostrarDieta();
$tituloPagina = 'Dietas';

$contenidoPrincipal = <<<EOS
    $htmlDieta
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';