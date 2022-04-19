<?php

require_once __DIR__.'/includes/config.php';

$chatUsuario = new appweb\chat\MostrarChatEntrenador();
$MostrarChat = $chatUsuario->mostrarChat();

$FormularioLogros = new appweb\chat\MostrarLogrosEntrenador();
$MostrarLogros = $FormularioLogros->mostrarLogrosEnt();

$tituloPagina = 'Entrenador Personal';
$contenidoPrincipal = <<<EOS
<h1>Entrenador personal</h1>
<form method='post' id = "formChatEntrenador">
	$MostrarLogros
	$MostrarChat
</form>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';