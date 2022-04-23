<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/productos.php';

$htmlProductos = listaProductos();
$form = new appweb\productos\FormularioFiltrarProductos();
$htmlFilt = $form->gestiona();

//$form = new appweb\productos\FormularioPersonalizarProductos();
//$htmlPers = $form->gestiona();

$tituloPagina = 'Productos';

$contenidoPrincipal = <<<EOS
    $htmlFilt
    $htmlProductos
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';