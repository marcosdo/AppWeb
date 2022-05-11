<?php
  use appweb\Aplicacion;
  require_once __DIR__.'/includes/config.php';
  $app = Aplicacion::getInstance();
  if ($app->usuarioLogueado() == true){
    $tituloPagina = 'Contenido';
    $formContenido = new appweb\contenido\FormularioContenidoPrincipal();
    $htmlFormContenido = $formContenido->gestiona();
    $contenidoPrincipal = <<<EOS
    $htmlFormContenido
    EOS;
  }
  else {
    header('Location: login.php');
    exit();
  }
  require __DIR__.'/includes/vistas/plantillas/plantilla.php';