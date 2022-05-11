<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/planes.php';

if ($app->usuarioLogueado() == true){

	$idRutina = filter_input(INPUT_GET, 'idRutina', FILTER_SANITIZE_NUMBER_INT);
	if (!$idRutina) {
		appweb\Aplicacion::redirige($app->buildUrl('/verplan.php'));
	}

	$htmlRutina = mostrarRutina($idRutina);
	$tituloPagina = 'Rutina';

	$contenidoPrincipal = <<<EOS
	$htmlRutina
	EOS;
}
else {
  header('Location: login.php');
  exit();
}
require __DIR__.'/includes/vistas/plantillas/plantilla.php';