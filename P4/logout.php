<?php
require_once __DIR__.'/includes/config.php';


$app = appweb\Aplicacion::getInstance();
$app->logout();

$tituloPagina = 'Logout';

$contenidoPrincipal = <<<EOS
<h1>Página Logout</h1>
<p>Gracias por visitar nuestra web. ¡Hasta pronto!</p>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';