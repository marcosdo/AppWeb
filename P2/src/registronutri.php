<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="stylesheet" type="text/css" href="   ../resources/CSS/estiloaux.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Planificacion</title>
    </head>
    <body>
        <div id="contenedor">
            <?php
                session_start();
                require 'includes/vistas/cabecera.php';
                require 'includes/vistas/menu.php';
            ?>
            <main>
                <div id="tabla">
                    <form method="POST" action="pago.php">
                        <fieldset>
                            <legend> Por favor, introduzca sus datos:</legend>
                            Peso:<br><input type="text" name="peso" required/><br>
                            Altura:<br><input type="text" name="altura" required/><br>
                            Alergias:<br><input type="text" name="alergias"/><br>
                            Observaciones adicionales:<br><input type="text" name="observaciones"/><br>
                            <br><input type="submit" value="Pagar" /></br>
                        </fieldset>
                    </form>
                    <img src="../resources/Imagenes/nutricionista.jpg" alt="Tu nutri de confianza" >
                </div>
            </main>
            <?php
                require 'includes/vistas/anuncios.php';
                require 'includes/vistas/pie.php';
            ?>
        </div>
    </body>
</html>