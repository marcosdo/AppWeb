<?php
require_once __DIR__.'/includes/config.php';

// Coger los parametros $_GET: ?id=n, y si no existe redirigir al index
$idNoticia = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!$idNoticia) {
	appweb\Aplicacion::redirige($app->buildUrl('/noticias.php'));
}

$noticia = appweb\contenido\Noticias::buscaxID($idNoticia);
if (!$noticia) {
	appweb\Aplicacion::redirige($app->buildUrl('/noticias.php'));
}
$tituloPagina = 'Noticia';

$titulo = $noticia->getTitulo();
$cuerpo = $noticia->getCuerpo();

$contenidoPrincipal = <<<EOS
<div id='noticia'>
	<h1>{$titulo}</h1>
	<p>{$cuerpo}</p>
</div>
EOS;



require __DIR__.'/includes/vistas/plantillas/plantilla.php';