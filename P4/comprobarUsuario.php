<?php
require_once __DIR__.'/includes/config.php';
$usuario = $_GET['user'];

$existe = appweb\usuarios\Personas::buscaAlias($usuario);

if($existe) echo "El nombre de usuario no se encuentra disponible";
else echo "disponible";
