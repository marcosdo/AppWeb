
<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/productos.php';

// Params ?numPagina=X&numPorPagina=Y
$numPagina = filter_input(INPUT_GET, 'numPagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$numPorPagina = filter_input(INPUT_GET, 'numPorPagina', FILTER_SANITIZE_NUMBER_INT) ?? 9;

// Coger los productos recomendados
$productos = appweb\productos\Productos::getDataPers();
$htmlProductos = listaListaProductosPaginadas($productos, 'tiendapersonalizada.php', $numPorPagina, $numPagina);

$tituloPagina = 'Productos';
$contenidoPrincipal = <<<EOS
    $htmlProductos
EOS;

require_once __DIR__.'/includes/vistas/plantillas/plantilla.php';