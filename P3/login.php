<?php

require_once __DIR__.'/includes/config.php';

$form = new es\ucm\fdi\aw\FormularioLogin();
$htmlFormLogin = $form->gestiona();

$form2 = new es\ucm\fdi\aw\FormularioRegistro();
$htmlFormRegistro = $form2->gestiona();

$tituloPagina = 'Login';
$img = RUTA_IMGS;

$contenidoPrincipal = <<<EOS
<div class=form>
    <div class="thumbnail">
        <img src='$img/login.jpg' alt=thumbnail />
    </div>
    $htmlFormLogin
    $htmlFormRegistro
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';