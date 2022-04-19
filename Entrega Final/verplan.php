<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Planificacion';

$formRutina = new appweb\plan\FormularioVerRutina();
$formDieta = new appweb\plan\FormularioVerDieta();

$htmlFormRutina = $formRutina->gestiona();
$htmlFormDieta = $formDieta->gestiona();

$tituloPagina = 'Ver planificaciones';
 
$contenidoPrincipal = <<<EOS
<div class=verplan>
$htmlFormRutina
$htmlFormDieta
</div>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';