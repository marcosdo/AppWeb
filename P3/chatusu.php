<?php

require_once __DIR__.'/includes/config.php';

$chatUsuario = new es\ucm\fdi\aw\MostrarChatUsuario();
$MostrarChat = $chatUsuario->mostrarChat();

$Logros = new es\ucm\fdi\aw\MostrarLogrosUsuario();
$MostarLogros = $Logros->mostrarLogrosUsu();

$tituloPagina = 'Tu nutricionista';
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