<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/foro.php';

$html = muestraTemas();

if ($app->usuarioLogueado()) {
    $formCreaForo = new appweb\foro\FormularioForo();
    $htmlFormForo = $formCreaForo->gestiona();
}

$tituloPagina = 'Foro';
$contenidoPrincipal = <<<EOS
    <h1>Temas del foro</h1>
    <div id=tabla>
        $htmlFormForo
        $html
</div>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';