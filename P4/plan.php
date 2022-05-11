<?php

require_once __DIR__.'/includes/config.php';

if ($app->usuarioLogueado() == true){

    $tituloPagina = 'Planificacion';

    $form = new appweb\plan\FormularioRutinas();
    $form2 = new appweb\plan\FormularioDietas();

    $htmlFormRutinas = $form->gestiona();
    $htmlFormDietas = $form2->gestiona();

    $tituloPagina = 'Planificacion';
    
    $contenidoPrincipal = <<<EOS
    <div class=plan>
    $htmlFormRutinas
    $htmlFormDietas
    </div>
    EOS;
}
else {
        header('Location: login.php');
        exit();
}
      

require __DIR__.'/includes/vistas/plantillas/plantilla.php';