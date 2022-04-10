<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Planificacion';

$form = new appweb\FormularioRutinas();
$form2 = new appweb\FormularioDietas();

$htmlFormRutinas = $form->gestiona();
$htmlFormDietas = $form2->gestiona();

$tituloPagina = 'Planificacion';
 
$contenidoPrincipal = <<<EOS
<div class=plan>
$htmlFormRutinas
$htmlFormDietas
</div>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';