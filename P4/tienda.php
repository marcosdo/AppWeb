<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/productos.php';

// Params ?numPagina=X&numPorPagina=Y
$numPagina = filter_input(INPUT_GET, 'numPagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$numPorPagina = filter_input(INPUT_GET, 'numPorPagina', FILTER_SANITIZE_NUMBER_INT) ?? 9;

$precio = filter_input(INPUT_GET, 'precio', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$empresa = filter_input(INPUT_GET, 'empresa', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$tipo = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';

$productos = null;
// Ya se ha filtrado
if ($precio != '' && $tipo != '') {
    $productos = appweb\productos\Productos::buscaxFiltros($precio, $tipo, $empresa);
}
// No se ha filtrado
else $productos = appweb\productos\Productos::getData();

$htmlProductos = listaListaProductosPaginadas($productos, 'tienda.php', $numPorPagina, $numPagina);

// Filtrar productos: Precio, Empresa, Tipo
$form = new appweb\productos\FormularioFiltrarProductos();
$htmlFilt = $form->gestiona();

// Ver productos personalizados
$form2 = new appweb\productos\FormularioPersonalizarProductos();
$htmlPersProductos = $form2->gestiona();

$tituloPagina = 'Productos';
$contenidoPrincipal = <<<EOS
    $htmlFilt
    $htmlPersProductos
    $htmlProductos
EOS;

require_once __DIR__.'/includes/vistas/plantillas/plantilla.php';