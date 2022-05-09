<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/mensajes.php';

// Coger los parametros $_GET: ?id=n, y si no existe redirigir al index
$idMensaje = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!$idMensaje) {
	appweb\Aplicacion::redirige($app->buildUrl('/foros.php'));
}

$mensaje = appweb\foro\Mensaje::buscaxID($idMensaje);
if (!$mensaje) {
	appweb\Aplicacion::redirige($app->buildUrl('/foros.php'));
}

// Coger los parametros $_GET: ?numPagina=x&numPorPagina=y
$numPagina = filter_input(INPUT_GET, 'numPagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$numPorPagina = filter_input(INPUT_GET, 'numPorPagina', FILTER_SANITIZE_NUMBER_INT) ?? 3;

$tituloPagina = 'Mensaje';

$msg = $mensaje->getMensaje();
$tituloMensaje = $mensaje->getTitulo();

$contenidoPrincipal = "";
$contenidoPrincipal .= <<<EOS
<h1>$tituloMensaje</h1>
<div class = respuesta>{$msg}
EOS;

$html ='';

if ($app->usuarioLogueado()) {
	$html .= "<div class='msg'>";
	if ($app->idUsuario() == $mensaje->getIDUsuario()) {
		$html .= "<h4 class='message1'><a href='#'> Actualizar. <i class='fa-solid fa-pen-to-square'></i></a></h4>";
		$html .= botonEditaMensajeObjeto($mensaje, $mensaje->getIDRefencia());
	}
	if ($app->idUsuario() == $mensaje->getIDUsuario() || $app->esAdmin()) {
		$html .= "<h4 class='message2'><a href='#'> Borrar. <i class='fa-solid fa-pen-to-square'></i></a></h4>";
		$html .= botonBorraMensajeObjecto($mensaje, $mensaje->getIDRefencia());
	}
	$html .= "</div>";
}

$contenidoPrincipal .= $html . "</div>";

// Mensajes sin paginar
if ($mensaje->getIDRefencia() == null)
	$contenidoPrincipal .= listaMensajes($idMensaje, true, $idMensaje);

if ($app->usuarioLogueado()) {
	$form = new appweb\foro\FormularioCreaMensaje($idMensaje);
	$htmlFormMensaje = $form->gestiona();

	$contenidoPrincipal .= <<<EOS
		$htmlFormMensaje
	EOS;
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';