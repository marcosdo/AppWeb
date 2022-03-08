<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="stylesheet" type="text/css" href="../../estilo.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Planificacion</title>
    </head>
    <body>
        <div id="contenedor">
            <?php
                require '../layout/cabecera.php';
                require '../layout/sidebarIzq.php';
            ?>
            <main>
            <div id="form">
            <form method="get" action="procesaform.php">
                    <fieldset>
                        <legend> Por favor, introduzca sus datos:</legend>
                        Peso:<br><input type="text" name="peso"/><br>
                        Altura:<br><input type="text" name="altura" /><br>
                        Alergias:<br><input type="text" name="alergias"/><br>
                        Observaciones adicionales:<br><input type="text" name="observaciones"/><br>
                        <br><input type="submit" value="Pagar" /></br>
                    </fieldset>
                </form>
            </div>  
            <div id="imagen">
                <img src="../Imagenes/nutricionista.jpg" alt="Tu nutri de confianza" >
            </div>
            </main>
            <?php
                require '../layout/sidebarDer.php';
                require '../layout/pie.php';
            ?>
        </div>
    </body>
</html>