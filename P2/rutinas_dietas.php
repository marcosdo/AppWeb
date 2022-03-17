<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Planificacion';

$form = new es\ucm\fdi\aw\FormularioRutinas();
$form2 = new es\ucm\fdi\aw\FormularioDietas();

$htmlFormRutinas = $form->gestiona();
$htmlFormDietas = $form2->gestiona();

$tituloPagina = 'Planificacion';
 
$contenidoPrincipal = <<<EOS
<h1>Acceso al sistema</h1>
<div id="tabla">
$htmlFormRutinas
$htmlFormDietas
</div>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';