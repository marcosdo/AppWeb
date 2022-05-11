<?php

use appweb\Aplicacion;
require_once __DIR__.'/includes/config.php';
$app = Aplicacion::getInstance();
if ($app->usuarioLogueado() == true){

    $form = new appweb\chat\FormularioPago();
    $htmlFormPago = $form->gestiona();

    $tituloPagina = 'Pago';
    $contenidoPrincipal = <<<EOS
    <h1>Contratacion de nutricionista</h1>
    $htmlFormPago
    EOS;
}
else {
    header('Location: login.php');
    exit();
}
require __DIR__.'/includes/vistas/plantillas/plantilla.php';