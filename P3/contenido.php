<?php

  require_once __DIR__.'/includes/config.php';

  $tituloPagina = 'Contenido';
  $formContenido = new appweb\contenido\FormularioContenidoPrincipal();
  $htmlFormContenido = $formContenido->gestiona();
  $contenidoPrincipal = <<<EOS
    $htmlFormContenido
  EOS;

  require __DIR__.'/includes/vistas/plantillas/plantilla.php';