<?php

require_once __DIR__.'/includes/config.php';

$form = new \es\ucm\fdi\aw\FormularioAdmin();
$html = $form->gestiona();

$tituloPagina = 'Consola';
$contenidoPrincipal = <<<EOS
<h1>Consola de Administracion</h1>
<div id="consola">
$html
</div>
EOS;
require __DIR__.'/includes/vistas/plantillas/plantilla.php';