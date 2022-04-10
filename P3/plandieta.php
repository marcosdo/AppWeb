<?php 

require_once __DIR__.'/includes/config.php';

$tabla = new \appweb\PlanificacionDietas();
$html = $tabla->muestra_tabla();
$tituloPagina = 'Dietas';

$contenidoPrincipal = <<<EOS
    <h1>Dietas</h1>
    $html
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';