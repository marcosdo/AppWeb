<?php
require_once __DIR__.'/includes/config.php';
include __DIR__.'/includes/vistas/helpers/mensajes.php';

$idforo = filter_input(INPUT_GET, 'idforo', FILTER_SANITIZE_NUMBER_INT);
if (!appweb\foro\Foro::buscaxID($idforo)) {
    appweb\Aplicacion::redirige($app->buildUrl('/foros.php'));
}

$numPagina = filter_input(INPUT_GET, 'numPagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$numPorPagina = filter_input(INPUT_GET, 'numPorPagina', FILTER_SANITIZE_NUMBER_INT) ?? 5;

$msgs = appweb\foro\Mensaje::getMsgs($idforo, 'IS NULL');

$tituloPagina = 'Tablon';
$contenidoPrincipal = '<h1>Tablon de Anuncios</h1>';


$params = [ 'idforo' => $idforo ];
$contenidoPrincipal .= listaListaMensajesPaginados($msgs, false, null, 'foroaux.php', $params, $numPorPagina, $numPagina);

if (isset($_SESSION['rol'])) {
    $form = new appweb\foro\FormularioMensaje($idforo);
    $htmlFormMensaje = $form->gestiona();

    $contenidoPrincipal .= <<<EOS
        <h1>Nuevo Mensaje</h1>
        $htmlFormMensaje
    EOS;
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';