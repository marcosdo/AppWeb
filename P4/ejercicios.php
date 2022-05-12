<?php

    use appweb\Aplicacion;
    require_once __DIR__.'/includes/config.php';
    $app = Aplicacion::getInstance();
    if ($app->usuarioLogueado() == true){
        require_once __DIR__.'/includes/vistas/helpers/ejercicios.php';

        $numPagina = filter_input(INPUT_GET, 'numPagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
        $numPorPagina = filter_input(INPUT_GET, 'numPorPagina', FILTER_SANITIZE_NUMBER_INT) ?? 18;

        $musculo = filter_input(INPUT_GET, 'musculo', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
        $tipo = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
        $nombre = filter_input(INPUT_GET, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';

        $html = '';
        // Ya se ha filtrado
        if ($musculo != '' || $tipo != '' || $nombre != '') {
            $cond = "";
            if ($tipo != '') {
                $cond = "tipo = $tipo";
                if($musculo != '') $cond .= " AND musculo = '{$musculo}'";
                if($nombre != '') $cond .= " AND nombre LIKE '%{$nombre}%'";
            }
            else {
                if($musculo != ''){
                    $cond = "musculo = '{$musculo}'";
                    if($nombre != '') $cond .= " AND nombre LIKE '%{$nombre}%'";
                }
                else $cond = "nombre LIKE '%{$nombre}%'";
            }
            $ejercicios = appweb\contenido\Ejercicios::getData($cond);

        }
        // No se ha filtrado
        else $ejercicios = appweb\contenido\Ejercicios::getData("1");


        $html .= "<div class='creafiltra'><h4 class='message3'><a href='#'> Filtrar. <i class='fa-solid fa-magnifying-glass'></i></a></h4>";
        $html .= filtrarEjercicio();


        $lista = listaListaEjerciciosPaginadas($ejercicios, 'ejercicios.php', $numPorPagina, $numPagina);

        $tituloPagina = 'Ejercicios';
        $contenidoPrincipal = <<<EOS
        <h1>EJERCICIOS</h1>
        $html
        $lista
        EOS;
    }
    else {
        header('Location: login.php');
        exit();
    }
require __DIR__.'/includes/vistas/plantillas/plantilla.php';