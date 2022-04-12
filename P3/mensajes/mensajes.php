<?php
require_once dirname(__DIR__).'/includes/config.php';

include RAIZ_APP.'/vistas/helpers/mensajes.php';

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

$msg = $mensaje->getMessage();

$contenidoPrincipal = <<<EOS
<h1>Mensaje</h1>
<p>{$msg}</p>
EOS;

/* Mensajes sin paginar 
$contenidoPrincipal .= listaMensajes($mensaje->id, true, $idMensaje);
*/

/* Mensajes paginados */
//$contenidoPrincipal .= listaListaMensajesPaginados($mensaje, true, $idMensaje, $numPorPagina, $numPagina);

if ($app->usuarioLogueado()) {
	/*
	$formRespuesta = new FormularioRespuesta($idMensaje);
	$htmlFormRespuesta = $formRespuesta->gestiona();
	$contenidoPrincipal .= <<<EOS
		<h1>Responder</h1>
		$htmlFormRespuesta
	EOS;
	*/
}

require RAIZ_APP.'/vistas/plantillas/plantilla.php';