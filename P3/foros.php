<?php
require_once __DIR__.'/includes/config.php';

function muestraTemas($data) {
    $html = "<caption>Lista de temas:</caption>";
    $tema = array_column($data, 'tema');
    $idforo = array_column($data, 'id_foro');
    for ($i = 0; $i < count($data); $i++)
        $html .= "<li><a href='foroaux.php?idforo={$idforo[$i]}'>{$tema[$i]}</a></li>";
    return $html;
}

$class = new appweb\foro\MostrarTemas();
$data = $class->getData();
$html = muestraTemas($data);

$form = new appweb\foro\FormularioForo();
$htmlFormForo = $form->gestiona();

$tituloPagina = 'Foro';
$contenidoPrincipal = <<<EOS
<h1>Temas del foro</h1>
<h3>Lista de temas</h3>
$html
<h3>¿Quieres crear un nuevo tema?</h3>
$htmlFormForo
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';