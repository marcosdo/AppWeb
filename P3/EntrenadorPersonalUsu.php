<?php
require_once __DIR__.'/includes/config.php';
$tituloPagina = 'Tu nutricionista';

$chatUsuario = new es\ucm\fdi\aw\ChatUsuario();
$MostrarChat = $chatUsuario->mostrarChat();

$Logros = new es\ucm\fdi\aw\Logros();
$MostarLogros = $Logros->mostrarLogros();


$contenidoPrincipal = <<<EOS
<h1>Tu nutricionista</h1>
	<div id = "logros">
		$MostarLogros
	</div>
	<form method="post">
		$MostrarChat
	</form>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';