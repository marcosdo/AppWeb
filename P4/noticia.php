<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/noticias.php';

// Coger los parametros $_GET: ?id=n, y si no existe redirigir al index
$idNoticia = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!$idNoticia) {
	appweb\Aplicacion::redirige($app->buildUrl('/noticias.php'));
}

$noticia = appweb\contenido\Noticias::buscaxID($idNoticia);
if (!$noticia) {
	appweb\Aplicacion::redirige($app->buildUrl('/noticias.php'));
}

$numPagina = filter_input(INPUT_GET, 'numPagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$numPorPagina = filter_input(INPUT_GET, 'numPorPagina', FILTER_SANITIZE_NUMBER_INT) ?? 3;

$tituloPagina = 'Noticia';

$titulo = $noticia->getTitulo();
$cuerpo = $noticia->getCuerpo();

$contenidoPrincipal = <<<EOS
<h1>{$titulo}</h1>
<p>{$cuerpo}</p>
EOS;



require __DIR__.'/includes/vistas/plantillas/plantilla.php';