<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/productos.php';

$numPagina = filter_input(INPUT_GET, 'numPagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$numPorPagina = filter_input(INPUT_GET, 'numPorPagina', FILTER_SANITIZE_NUMBER_INT) ?? 9;

$productos = appweb\productos\Productos::getData();
$htmlProductos = listaListaProductosPaginadas($productos, 'tienda.php', $numPorPagina, $numPagina);

$form = new appweb\productos\FormularioFiltrarProductos();
$htmlFilt = $form->gestiona();

//$form = new appweb\productos\FormularioPersonalizarProductos();
//$htmlPers = $form->gestiona();

$tituloPagina = 'Productos';

$contenidoPrincipal = <<<EOS
    $htmlFilt
    $htmlProductos
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';