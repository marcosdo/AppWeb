<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/productos.php';

$htmlProductos = listaProductos();
$form = new appweb\productos\FormularioPersonalizarProdutos();
$htmlPers = $form->gestiona();

$tituloPagina = 'Productos';

$contenidoPrincipal = <<<EOS
    $htmlProductos
    $formPers
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';