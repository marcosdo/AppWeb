<?php
  use appweb\Aplicacion;
  require_once __DIR__.'/includes/config.php';
  $app = Aplicacion::getInstance();
  if ($app->usuarioLogueado() == true){
    require_once __DIR__.'/includes/vistas/helpers/recetas.php';

    $numPagina = filter_input(INPUT_GET, 'numPagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
    $numPorPagina = filter_input(INPUT_GET, 'numPorPagina', FILTER_SANITIZE_NUMBER_INT) ?? 3;

    $objetivo = filter_input(INPUT_GET, 'objetivo', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    $tipo = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';

    // Ya se ha filtrado
    if ($objetivo != '' || $tipo != '') {
        $cond = "";
        if ($objetivo != '') {
            $cond = "objetivo = $objetivo";
            if($tipo != '') $cond .= " AND tipo = '{$tipo}'";
        }
        else {
            $cond = "tipo = '{$tipo}'";
        }
        $recetas = appweb\contenido\Comidas::getData($cond);
    }
    // No se ha filtrado
    else $recetas = appweb\contenido\Comidas::getData("1");

    $html = "<div class='creafiltra'><h4 class='message4'><a href='#'> Filtrar. <i class='fa-solid fa-magnifying-glass'></i></a></h4>";
    $html .= FiltraProducto();

    $lista = listaListaRecetasPaginadas($recetas, 'recetas.php', $numPorPagina, $numPagina);


    $tituloPagina = 'Recetas';
    $contenidoPrincipal = <<<EOS
    <h1>RECETAS</h1>
    $html
    $lista
    EOS;
    }
    else {
        header('Location: login.php');
        exit();
    }
require __DIR__.'/includes/vistas/plantillas/plantilla.php';