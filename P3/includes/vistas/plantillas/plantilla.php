<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title><?= $tituloPagina ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= RUTA_CSS ?>/estilo.css" />
	<script src="jquery-1.3.2.min.js" type="text/javascript"></script>
</head>
<body>
<div id="contenedor">
<?php
require(RAIZ_APP.'/vistas/comun/cabecera.php');
require(RAIZ_APP.'/vistas/comun/menu.php');
?>
	<main>
		<article>
			<?= $contenidoPrincipal ?>
		</article>
	</main>
<?php
require(RAIZ_APP.'/vistas/comun/anuncios.php');
require(RAIZ_APP.'/vistas/comun/pie.php');
?>
</div>
<?php
	$ruta = RUTA_JS;
	echo "<script type=text/javascript src=$ruta/mootools.1.2.3.js></script>
	<script type=text/javascript src=$ruta/main.js></script>";
?>
</body>
</html>