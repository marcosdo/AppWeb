<?php
require_once __DIR__.'/includes/config.php';

if ($app->usuarioLogueado() == true){
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
		<div id='carac-producto'>
			<img src="$ruta/productos/$idProducto.png" alt="LIFETY">
			<h4>Precio {$precio}€</h4>
			<h4>Marca {$empresa}</h4>
			<h4>Producto {$tipo}</h4>
		</div>
		<p>{$descripcion}</p>
		<div id='enlace-comprarp'>
		<a href=$link class="comprar-producto">Comprar</a>
		</div>
	</div>
	EOS;
}
else {
  header('Location: login.php');
  exit();
}
require __DIR__.'/includes/vistas/plantillas/plantilla.php';