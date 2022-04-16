<?php
require_once __DIR__.'/includes/config.php';

require_once __DIR__.'/includes/vistas/helpers/mensajes.php';

$idMensaje = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!$idMensaje) {
	appweb\Aplicacion::redirige($app->buildUrl('/index.php'));
}

$mensaje = appweb\foro\Mensaje::buscaxID($idMensaje);
if (!$mensaje) {
	appweb\Aplicacion::redirige($app->buildUrl('/index.php'));
}

$numPagina = filter_input(INPUT_GET, 'numPagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$numPorPagina = filter_input(INPUT_GET, 'numPorPagina', FILTER_SANITIZE_NUMBER_INT) ?? 3;

$tituloPagina = 'Mensaje';
$contenidoPrincipal = "";

$msg = $mensaje->getMessage();

$contenidoPrincipal .= <<<EOS
<h1>Mensaje</h1>
<p>{$msg}</p>
EOS;
// Mensajes sin paginar
$contenidoPrincipal .= listaMensajes($idMensaje, true, $idMensaje);

if ($app->usuarioLogueado()) {
	$form = new appweb\foro\FormularioMensaje();
	$htmlFormMensaje = $form->gestiona();

	$contenidoPrincipal .= <<<EOS
		$htmlFormMensaje
	EOS;
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';