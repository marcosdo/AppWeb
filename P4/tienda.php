<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/productos.php';

// Params ?numPagina=X&numPorPagina=Y
$numPagina = filter_input(INPUT_GET, 'numPagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$numPorPagina = filter_input(INPUT_GET, 'numPorPagina', FILTER_SANITIZE_NUMBER_INT) ?? 9;

// Coger todos los productos
$productos = appweb\productos\Productos::getData();
$htmlProductos = listaListaProductosPaginadas($productos, 'tienda.php', $numPorPagina, $numPagina);

// Filtrar productos: Precio, Empresa, Tipo
$form = new appweb\productos\FormularioFiltrarProductos();
$htmlFilt = $form->gestiona();

// Ver productos personalizados
$form2 = new appweb\productos\FormularioPersonalizarProductos();
$htmlPersProductos = $form->gestiona();

$tituloPagina = 'Productos';
$contenidoPrincipal = <<<EOS
    $htmlFilt
    $htmlProductos
    $htmlPersProductos
EOS;

require_once __DIR__.'/includes/vistas/plantillas/plantilla.php';