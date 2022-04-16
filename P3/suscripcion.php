<?php

require_once __DIR__.'/includes/config.php';

$form = new appweb\chat\FormularioPago();
$htmlFormPago = $form->gestiona();

$tituloPagina = 'Pago';
$ruta = RUTA_IMGS;
$contenidoPrincipal = <<<EOS
<h1>Contratacion de nutricionista</h1>
<div id="tabla">
$htmlFormPago
<img src="$ruta/nutricionista.jpg" alt="Tu nutri de confianza" >
</div>
EOS;
require __DIR__.'/includes/vistas/plantillas/plantilla.php';