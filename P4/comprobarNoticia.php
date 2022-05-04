<?php
require_once __DIR__.'/includes/config.php';
$titulo = $_GET['titulo'];

$existe = appweb\contenido\Noticias::buscaTitulo($titulo);

if($existe) echo "El titulo de la noticia no se encuentra disponible ya que ya hay una noticia con ese titulo";
else echo "disponible";