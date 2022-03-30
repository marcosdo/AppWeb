<?php
    namespace es\ucm\fdi\aw;
?>
<nav id="menu">
    <h3>Navegación</h3>
    <ul>
        <li><a href="<?= RUTA_APP ?>/index.php">Inicio</a></li>
        <?php
        	$rutaApp = RUTA_APP;
            if(isset($_SESSION['login']) && ($_SESSION["login"]===true)){
                echo "<li><a href='rutinas_dietas.php'>Planificacion</a></li>";
                if(isset($_SESSION['nutri']) && ($_SESSION["nutri"]===true)) echo "<li><a href='EntrenadorPersonalEnt.php'>Nutricionista</a></li>";
                else {
                    if(isset($_SESSION['premium']) && $_SESSION['premium'] == 1) echo "<li><a href='EntrenadorPersonalUsu.php'>Nutricionista</a></li>";
                    else echo "<li><a href='registronutri.php'>Nutricionista</a></li>";
                }
            }
        ?>
    </ul>
</nav>