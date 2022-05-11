<?php
  use appweb\Aplicacion;
  require_once __DIR__.'/includes/config.php';
  $app = Aplicacion::getInstance();
  if ($app->usuarioLogueado() == true){
    require_once __DIR__.'/includes/vistas/helpers/noticias.php';

    $numPagina = filter_input(INPUT_GET, 'numPagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
    $numPorPagina = filter_input(INPUT_GET, 'numPorPagina', FILTER_SANITIZE_NUMBER_INT) ?? 10;

    $noticias = appweb\contenido\Noticias::getData();
    $lista = listaListaNoticiasPaginadas($noticias, 'noticias.php', $numPorPagina, $numPagina);

    $tituloPagina = 'Noticias';
    $contenidoPrincipal = <<<EOS
    <h1>NOTICIAS</h1>
    $lista
    EOS;
    }
    else {
        header('Location: login.php');
        exit();
    }
require __DIR__.'/includes/vistas/plantillas/plantilla.php';