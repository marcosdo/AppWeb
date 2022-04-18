<?php

require_once __DIR__.'/includes/config.php';


$form = new appweb\plan\FormularioPlanEntrenadorRutina();
$form2 = new appweb\plan\FormularioPlanEntrenadorDieta();

$htmlFormRutinas = $form->gestiona();
$htmlFormDietas = $form2->gestiona();
$tituloPagina = 'Modificación de Planificación por Nutricionista';
$html = "-";
$contenidoPrincipal = <<<EOS
$htmlFormRutinas
$htmlFormDietas
EOS;


require __DIR__.'/includes/vistas/plantillas/plantilla.php';