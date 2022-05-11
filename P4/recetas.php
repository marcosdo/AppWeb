<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/recetas.php';

$numPagina = filter_input(INPUT_GET, 'numPagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$numPorPagina = filter_input(INPUT_GET, 'numPorPagina', FILTER_SANITIZE_NUMBER_INT) ?? 3;

$objetivo = filter_input(INPUT_GET, 'objetivo', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$tipo = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';

// Ya se ha filtrado
if ($objetivo != '' || $tipo != '') {
    $cond = "";
    if ($objetivo != '') {
        $cond = "objetivo = $objetivo";
        if($tipo != '') $cond .= ", tipo = $tipo";
    }
    else {
        $cond = "tipo = '{$tipo}'";
    }
    $recetas = appweb\contenido\Comidas::getData($cond);
}
// No se ha filtrado
else $recetas = appweb\contenido\Comidas::getData("1");

$form = new appweb\contenido\FormularioFiltrarRecetas();
$htmlFilt = $form->gestiona();

$lista = listaListaRecetasPaginadas($recetas, 'recetas.php', $numPorPagina, $numPagina);


$tituloPagina = 'Recetas';
$contenidoPrincipal = <<<EOS
<h1>RECETAS</h1>
$htmlFilt
$lista
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';