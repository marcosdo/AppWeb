<?php namespace es\ucm\fdi\aw; ?>
<nav id="menu">
    <h3>Navegación</h3>
    <ul>
        <li><a href="<?= RUTA_APP ?>/index.php">Portada</a></li>
        <?php
        	$rutaApp = RUTA_APP;
            if (isset($_SESSION['login']) && ($_SESSION["login"] === true)) {
                echo "<li><a href='plan.php'>Planificación</a></li>";
                if (isset($_SESSION['nutri']) && ($_SESSION["nutri"] === true))
                    echo "<li><a href='chatprof.php'>Chat</a></li>";
                else {
                    if (isset($_SESSION['premium']) && $_SESSION['premium'] == 1) 
                        echo "<li><a href='chatusu.php'>Seguimiento</a></li>";
                    else 
                        echo "<li><a href='suscripcion.php'>Seguimiento</a></li>";
                }
            }
        ?>
    </ul>
</nav>