<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/recetas.php';

$numPagina = filter_input(INPUT_GET, 'numPagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$numPorPagina = filter_input(INPUT_GET, 'numPorPagina', FILTER_SANITIZE_NUMBER_INT) ?? 3;

$recetas = appweb\contenido\Comidas::getData();
$lista = listaListaRecetasPaginadas($recetas, 'recetas.php', $numPorPagina, $numPagina);

$tituloPagina = 'Recetas';
$contenidoPrincipal = <<<EOS
<h1>RECETAS</h1>
$lista
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';