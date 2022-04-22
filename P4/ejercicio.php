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

$imagen = $ejercicio->getImagen();
$nombre = $ejercicio->getNombre();
$descripcion = $ejercicio->getDescripcion();
$musculo = $ejercicio->getMusculo();
$tipo = $ejercicio->getTipo();

$contenidoPrincipal = <<<EOS
<h1>{$nombre}</h1>
<p>{$descripcion}</p>
<p>{$musculo}</p>
<p>{$tipo}</p>
EOS;



require __DIR__.'/includes/vistas/plantillas/plantilla.php';