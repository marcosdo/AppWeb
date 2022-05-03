<?php
require_once __DIR__.'/includes/config.php';

// Coger los parametros $_GET: ?id=n, y si no existe redirigir al index
$idProducto = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!$idProducto) {
	appweb\Aplicacion::redirige($app->buildUrl('/productos.php'));
}

$producto = appweb\productos\Productos::buscaProducto($idProducto);

if (!$producto) {
	appweb\Aplicacion::redirige($app->buildUrl('/productos.php'));
}

$tituloPagina = 'Producto';

$precio = $producto->getPrecio();
$link = $producto->getLink();
$empresa = $producto->getEmpresa();
$nombre = $producto->getNombre();
$descripcion = $producto->getDescripcion();
$tipo = $producto->getTipo();
$ruta = RUTA_IMGS;

$contenidoPrincipal = <<<EOS
<h1>{$nombre}</h1>
<div id='producto'>
	<img src="$ruta/productos/$idProducto.png" alt="LIFETY">
	<h2>Precio {$precio}€</h2>
	<p>Se trata de {$tipo} de la marca {$empresa}. {$descripcion}</p>

	<a href=$link class="comprar-producto">Comprar</a>

</div>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';