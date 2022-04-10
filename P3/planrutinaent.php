<?php

require_once __DIR__.'/includes/config.php';


$form = new appweb\plan\FormularioEditarRutina();
$htmlFormRutinas = $form->gestiona();
$tituloPagina = 'Modificación de Planificación por Nutricionista';
$html = "-";
$contenidoPrincipal = <<<EOS
    $htmlFormRutinas
EOS;


require __DIR__.'/includes/vistas/plantillas/plantilla.php';