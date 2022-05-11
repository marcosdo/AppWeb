<?php

require_once __DIR__.'/includes/config.php';
if ($app->usuarioLogueado() == true){
    $tituloPagina = 'Planificacion';

    $formRutina = new appweb\plan\FormularioVerRutina();
    $formDieta = new appweb\plan\FormularioVerDieta();

    $htmlFormRutina = $formRutina->gestiona();
    $htmlFormDieta = $formDieta->gestiona();

    $tituloPagina = 'Ver planificaciones';
    
    $contenidoPrincipal = <<<EOS
    <div class=verplan>
    $htmlFormDieta
    $htmlFormRutina
    </div>
    EOS;
}
else {
  header('Location: login.php');
  exit();
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';