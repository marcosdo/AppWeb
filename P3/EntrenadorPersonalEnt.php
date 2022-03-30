<?php

require_once __DIR__.'/includes/config.php';

$chatUsuario = new es\ucm\fdi\aw\ChatEntrenador();
$MostrarChat = $chatUsuario->mostrarChat();

require_once __DIR__ .'/includes/FormularioLogros.php';

$FormularioLogros = new es\ucm\fdi\aw\FormularioLogros();
$MostrarLogros = $FormularioLogros->mostrarFormulario();

$tituloPagina = 'Entrenador Personal';

$contenidoPrincipal = <<<EOS
<h1>Entrenador personal</h1>
<form method='post'>
<div id = "logros" >
	$MostrarLogros
</div>
	$MostrarChat
</form>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';