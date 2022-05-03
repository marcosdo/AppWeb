<?php

use appweb\Aplicacion;

/**
 * Devuelve el HTML necesario para mostrar la zona de inicio de sesion con las variables de sesion puestas
 * @return html 
 */
function mostrarSaludo() {
    $app = Aplicacion::getInstance();

    $rutaApp = RUTA_APP;
    $html='';
    if ($app->usuarioLogueado()) {
        return "{$app->nombreUsuario()} <a href=".RUTA_APP."/micuenta.php><i class='fa-solid fa-circle-user'></i></i></a>
        <a href='{$rutaApp}/logout.php'><i class='fa-solid fa-right-from-bracket'></i></a>";
    } else {
        return "<a href='$rutaApp/login.php#'>Login.</a>";
    }
    return $html;
}
?>

<header>
    <div class="logo">
        <h1>Lifety</h1>
    </div>

    <div class="saludo">
        <?= mostrarSaludo() ?>
    </div>
</header>