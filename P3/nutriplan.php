<?php

require_once __DIR__.'/includes/config.php';


$form = new appweb\FormularioPlanEntRutina();
$htmlFormRutinas = $form->gestiona();
$htmlFormDietas = $htmlFormRutinas;
$tituloPagina = 'Modificación de Planificación por Nutricionista';
$html = "-";
$contenidoPrincipal = <<<EOS
<div class=plan>
$htmlFormRutinas
$htmlFormDietas
</div>
EOS;


require __DIR__.'/includes/vistas/plantillas/plantilla.php';