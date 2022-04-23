<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/noticias.php';

$numPagina = filter_input(INPUT_GET, 'numPagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$numPorPagina = filter_input(INPUT_GET, 'numPorPagina', FILTER_SANITIZE_NUMBER_INT) ?? 10;

$noticias = appweb\contenido\Noticias::getData();
$lista = listaListaNoticiasPaginadas($noticias, 'noticias.php', $numPorPagina, $numPagina);

$form = new appweb\contenido\FormularioCreaNoticia();
$htmlFormNoticia = $form->gestiona();

$tituloPagina = 'Noticias';
$contenidoPrincipal = <<<EOS
<h1>NOTICIAS</h1>
$htmlFormNoticia
$lista
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';