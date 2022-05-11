<?php
use appweb\Aplicacion;
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/foro.php';
$app = Aplicacion::getInstance();
	if ($app->usuarioLogueado() == true){
        $html = muestraTemas();
        $htmlFormForo = "";

        if ($app->usuarioLogueado()) {
            $formCreaForo = new appweb\foro\FormularioForo();
            $htmlFormForo = $formCreaForo->gestiona();
        }

        $tituloPagina = 'Foro';
        $contenidoPrincipal = <<<EOS
            <h1>Temas del foro</h1>
            $html
            $htmlFormForo
            <div id=tabla>
            </div>
        EOS;
    }
    else {
		header('Location: login.php');
		exit();
	}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';