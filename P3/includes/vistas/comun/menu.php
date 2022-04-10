<?php namespace es\ucm\fdi\aw; ?>
<nav>
    <div class="navbar">
        <div class="container nav-container">
            <input class="checkbox" type="checkbox" name="" id="" />
            <div class="hamburger-lines">
                <span class="line line1"></span>
                <span class="line line2"></span>
                <span class="line line3"></span>
            </div> 
            <div class="menu-items">
                <ul>
                    <li><a href="<?= RUTA_APP ?>/index.php">PORTADA</a></li>
                    <?php
                        $rutaApp = RUTA_APP;
                        if (isset($_SESSION['login']) && ($_SESSION["login"] === true)) { 
                            echo "<li><a href='foros.php'>FORO</a></li>";  
                            if (isset($_SESSION['nutri']) && ($_SESSION["nutri"] === true)){
                                echo "<li><a href='chatprof.php'>CHAT</a></li>";
                                echo "<li><a href='nutriplan.php'>PLANIFICACION</a></li>";
                            }
                            else {
                                if (isset($_SESSION['premium']) && $_SESSION['premium'] == 1) 
                                    echo "<li><a href='chatusu.php'>SEGUIMIENTO</a></li>";
                                else 
                                    echo "<li><a href='suscripcion.php'>SEGUIMIENTO</a></li>";
                                    echo "<li><a href='plan.php'>PLANIFICACION</a></li>";
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</nav>