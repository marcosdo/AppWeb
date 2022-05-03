<?php
require_once __DIR__.'/includes/config.php';

// Coger los parametros $_GET: ?id=n, y si no existe redirigir al index
$idProducto = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!$idProducto) {
	appweb\Aplicacion::redirige($app->buildUrl('/productos.php'));
}

$producto = appweb\productos\Productos::getProducto($idProducto);

if (!$producto) {
	appweb\Aplicacion::redirige($app->buildUrl('/productos.php'));
}

$tituloPagina = 'Producto';


$contenidoPrincipal = <<<EOS
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';