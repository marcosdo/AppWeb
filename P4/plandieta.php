<?php 

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/planes.php';

if ($app->usuarioLogueado() == true){
    $htmlDieta = mostrarDieta();
    $tituloPagina = 'Dietas';

    $contenidoPrincipal = <<<EOS
        $htmlDieta
    EOS;
}
else {
  appweb\Aplicacion::redirige($app->buildUrl('/login.php'));

}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';