<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/ejercicios.php';

$numPagina = filter_input(INPUT_GET, 'numPagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$numPorPagina = filter_input(INPUT_GET, 'numPorPagina', FILTER_SANITIZE_NUMBER_INT) ?? 18;

$ejercicios = appweb\contenido\Ejercicios::getData();
$lista = listaListaEjerciciosPaginadas($ejercicios, 'ejercicios.php', $numPorPagina, $numPagina);

$form = new appweb\contenido\FormularioCreaEjercicio();
$htmlFormEjercicio = $form->gestiona();

$tituloPagina = 'Ejercicios';
$contenidoPrincipal = <<<EOS
<h1>EJERCICIOS</h1>
$htmlFormEjercicio
$lista
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';