<?php 

require_once __DIR__.'/includes/config.php';

$foro = new \es\ucm\fdi\aw\MostrarForo(); 
$html = $foro->muestra_foro();
$tituloPagina = 'Foros';

$contenidoPrincipal = <<<EOS
    <h1>Foro</h1>
    $html
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';