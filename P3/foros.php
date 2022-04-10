<?php

require_once __DIR__.'/includes/config.php';

$class = new appweb\foro\MostrarTemas();
$html = $class->muestra_temas();

$form = new appweb\foro\FormularioForo();
$htmlFormForo = $form->gestiona();

$tituloPagina = 'Foro';
$contenidoPrincipal = <<<EOS
<h1>Temas del foro</h1>
<h3>¿Quieres crear un nuevo tema?</h3>
$htmlFormForo
<h3>Lista de temas</h3>
$html
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';