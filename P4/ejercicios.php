<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/ejercicios.php';

$numPagina = filter_input(INPUT_GET, 'numPagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$numPorPagina = filter_input(INPUT_GET, 'numPorPagina', FILTER_SANITIZE_NUMBER_INT) ?? 18;

$musculo = filter_input(INPUT_GET, 'musculo', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$tipo = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';

// Ya se ha filtrado
if ($musculo != '' || $tipo != '') {
    $cond = "";
    if ($musculo != '') {
        $cond = "musculo = $musculo";
        if($tipo != '') $cond .= ", tipo = $tipo";
    }
    else {
        $cond = "tipo = $tipo";
    }
    $recetas = appweb\contenido\Ejercicios::getData($cond);

}
// No se ha filtrado
else $ejercicios = appweb\contenido\Ejercicios::getData("1");

$form = new appweb\contenido\FormularioFiltrarEjercicios();
$htmlFilt = $form->gestiona();

$lista = listaListaEjerciciosPaginadas($ejercicios, 'ejercicios.php', $numPorPagina, $numPagina);

$tituloPagina = 'Ejercicios';
$contenidoPrincipal = <<<EOS
<h1>EJERCICIOS</h1>
$htmlFilt
$lista
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';