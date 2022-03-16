<?php
    namespace es\ucm\fdi\aw;
?>
<nav id="menu">
    <h3>Navegación</h3>
    <ul>
        <li><a href="<?= RUTA_APP ?>/index.php">Inicio</a></li>
        <li><a href="<?= RUTA_APP ?>/rutinas_dietas.php">Planificacion</a></li>
        <?php
        	$rutaApp = RUTA_APP;
            if(isset($_SESSION['login']) && ($_SESSION["login"]===true)){
                if(isset($_SESSION['nutri']) && ($_SESSION["nutri"]===true)) echo "<li><a href='EntrenadorPersonalEnt.php'>Nutricionista</a></li>";
                else {
                    $user = Usuario::buscaPorId($_SESSION['id']);
                    if($user->getPremium()) echo "<li><a href='EntrenadorPersonalUsu.php'>Nutricionista</a></li>";
                    else echo "<li><a href='registronutri.php'>Nutricionista</a></li>";
                }
            }
        ?>
    </ul>
</nav>