<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Planificacion';

$form = new es\ucm\fdi\aw\FormularioRutinas();
//$form2 = new es\ucm\fdi\aw\FormularioDietas();

$htmlFormRutinas = $form->gestiona();
//$htmlFormDietas = $form2->gestiona();
$tituloPagina = 'Planificacion';

//$htmlFormDietas 
$contenidoPrincipal = <<<EOS
<h1>Acceso al sistema</h1>
$htmlFormRutinas
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';