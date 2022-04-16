<?php
require_once __DIR__.'/includes/config.php';
include __DIR__.'/includes/vistas/helpers/mensajes.php';

$idforo = filter_input(INPUT_GET, 'idforo', FILTER_SANITIZE_NUMBER_INT);
if (!appweb\foro\Foro::buscaxID($idforo)) {
    appweb\Aplicacion::redirige($app->buildUrl('/foros.php'));
}

$msgs = appweb\foro\Mensaje::getMsgs($idforo, 'IS NULL');

$tituloPagina = 'Tablon';
$contenidoPrincipal = '<h1>Tablon de Anuncios</h1>';
$contenidoPrincipal .= listaListaMensajesPaginados($msgs);
if (isset($_SESSION['rol'])) {
    $mensaje = new appweb\foro\FormularioMensaje($idforo);
    $htmlFormMensaje = $mensaje->gestiona();

    $contenidoPrincipal .= <<<EOS
        <h1>Nuevo Mensaje</h1>
        $htmlFormMensaje
    EOS;
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';