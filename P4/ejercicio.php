<?php
require_once __DIR__.'/includes/config.php';

// Coger los parametros $_GET: ?id=n, y si no existe redirigir al index
$idEjercicio = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!$idEjercicio) {
	appweb\Aplicacion::redirige($app->buildUrl('/ejercicios.php'));
}

$ejercicio = appweb\contenido\Ejercicios::buscaxID($idEjercicio);
if (!$ejercicio) {
	appweb\Aplicacion::redirige($app->buildUrl('/ejercicios.php'));
}

$tituloPagina = 'Ejercicio';

$imagen = $ejercicio->getId_ejercicio();
$nombre = $ejercicio->getNombre();
$descripcion = $ejercicio->getDescripcion();
$musculo = $ejercicio->getMusculo();
$tipo = $ejercicio->getTipo();
$ruta = RUTA_IMGS;

switch($tipo) {
	case 0: $aux = "fuerza";
	case 1: $aux = "hipertrofia";
	case 2: $aux = "resistencia";
}
$contenidoPrincipal = <<<EOS
<h1>{$nombre}</h1>
<div id='ejercicio'>
	<img src="$ruta/ejercicios/$imagen.png" alt="LIFETY">
	<p>Musculo entrenado: {$musculo}</p>
	<p>Util para mejorar la {$aux}</p>
	<p>{$descripcion}</p>
</div>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';