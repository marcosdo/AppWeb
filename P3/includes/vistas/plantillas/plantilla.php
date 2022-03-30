<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title><?= $tituloPagina ?></title>
    <link rel="stylesheet" type="text/css" href="<?= RUTA_CSS ?>/estilo.css" />
</head>
<body>
<div id="contenedor">
<?php
require(RAIZ_APP.'/vistas/comun/cabecera.php');
echo "<div id='centro'>";
require(RAIZ_APP.'/vistas/comun/menu.php');
?>
	<main>
		<article>
			<?= $contenidoPrincipal ?>
		</article>
	</main>
<?php
require(RAIZ_APP.'/vistas/comun/anuncios.php');
echo "</div>";
require(RAIZ_APP.'/vistas/comun/pie.php');
?>
</div>
</body>
</html>