<?php
require_once __DIR__.'/includes/config.php';
$ejercicio = $_GET['ejercicio'];

$existe = appweb\contenido\Ejercicios::buscaNombre($ejercicio);

if($existe) echo "El ejercicio con ese nombre ya se encuentra registrado";
else echo "disponible";