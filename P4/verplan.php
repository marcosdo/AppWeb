<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Planificacion';

$formRutina = new appweb\plan\FormularioVerRutina();
$formDieta = new appweb\plan\FormularioVerDieta();

$htmlFormRutina = $formRutina->gestiona();
$htmlFormDieta = $formDieta->gestiona();

/*$formRutinas = new appweb\plan\FormularioVerRutinas();
$formDietas = new appweb\plan\FormularioVerDietas();

$htmlFormRutinas = $formRutinas->gestiona();
$htmlFormDietas = $formDietas->gestiona();*/

$tituloPagina = 'Ver planificaciones';
 
$contenidoPrincipal = <<<EOS
<div class=verplan>
$htmlFormRutina
$htmlFormDieta
</div>
<div class=verplan>
$htmlFormRutina
$htmlFormDieta
</div>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';