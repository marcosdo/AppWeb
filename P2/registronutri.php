<?php

require_once __DIR__.'/includes/config.php';

$form = new es\ucm\fdi\aw\FormularioPago();
$htmlFormLogin = $form->gestiona();

$tituloPagina = 'Pago';

$contenidoPrincipal = <<<EOS
<h1>Contratacion de nutricionista</h1>
<div id="tabla">
$htmlFormLogin
<img src="RUTA_IMGS/nutricionista.jpg" alt="Tu nutri de confianza" >
</div>
EOS;
require __DIR__.'/includes/vistas/plantillas/plantilla.php';