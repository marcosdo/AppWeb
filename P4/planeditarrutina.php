<?php

require_once __DIR__.'/includes/config.php';

$idUsuario = filter_input(INPUT_GET, 'idUsuario', FILTER_SANITIZE_NUMBER_INT);
if (!$idUsuario) {
	appweb\Aplicacion::redirige($app->buildUrl('/entrenadorplan.php'));
}

$form = new appweb\plan\FormularioEditarRutina($idUsuario);
$htmlFormRutinas = $form->gestiona();
$tituloPagina = 'Modificación de Planificación por Nutricionista';
$html = "-";
$contenidoPrincipal = <<<EOS
    $htmlFormRutinas
EOS;


require __DIR__.'/includes/vistas/plantillas/plantilla.php';