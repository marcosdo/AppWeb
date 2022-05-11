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
  header('Location: login.php');
  exit();
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';