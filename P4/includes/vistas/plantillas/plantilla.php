<?php
require_once __DIR__.'/plantilla_utils.php';

// Mensajes posibles de un accion de un php anterior
$mensajes = mensajesPeticionAnterior();
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <title><?= $tituloPagina ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="<?= RUTA_CSS ?>/estilo.css" />
        <script src="jquery-1.3.2.min.js" type="text/javascript"></script>
        <script src="https://kit.fontawesome.com/f34cf33e14.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <?= $mensajes ?>

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

    <footer>

    </footer>
</html>
