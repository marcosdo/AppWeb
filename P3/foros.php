<?php
require_once __DIR__.'/includes/config.php';

function muestraTemas($data) {
    $aux = "<div class=temas><h3>Lista de temas</h3>";
    $tema = array_column($data, 'tema');
    $idforo = array_column($data, 'id_foro');
    for ($i = 0; $i < count($data); $i++)
        $aux .= "<li><a href='foroaux.php?idforo={$idforo[$i]}'>{$tema[$i]}</a></li>";
    $aux .= "</div>";
    return $aux;
}

$class = new appweb\foro\MostrarTemas();
$data = $class->getData();
$html = muestraTemas($data);

$form = new appweb\foro\FormularioForo();
$htmlFormForo = $form->gestiona();

$tituloPagina = 'Foro';
$contenidoPrincipal = <<<EOS
<h1>Temas del foro</h1>
<div id=tabla>
    $htmlFormForo
    $html
</div>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';