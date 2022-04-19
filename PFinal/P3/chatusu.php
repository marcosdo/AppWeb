<?php

require_once __DIR__.'/includes/config.php';

$chatUsuario = new appweb\chat\MostrarChatUsuario();
$MostrarChat = $chatUsuario->mostrarChat();

$tituloPagina = 'Tu nutricionista';
$contenidoPrincipal = <<<EOS
<h1>Tu nutricionista</h1>
	<form method="post" id = "formChatUsuario">
		$MostrarChat
	</form>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';