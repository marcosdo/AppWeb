<?php

require_once __DIR__.'/includes/config.php';

$form = new appweb\chat\FormularioPago();
$htmlFormPago = $form->gestiona();

$tituloPagina = 'Pago';
$contenidoPrincipal = <<<EOS
<h1>Contratacion de nutricionista</h1>
$htmlFormPago
EOS;
require __DIR__.'/includes/vistas/plantillas/plantilla.php';