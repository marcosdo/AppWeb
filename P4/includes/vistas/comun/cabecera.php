<?php

use appweb\Aplicacion;

/**
 * Devuelve el HTML necesario para mostrar la zona de inicio de sesion con las variables de sesion puestas
 * @return html 
 */
function mostrarSaludo() {
    $app = Aplicacion::getInstance();

    $rutaApp = RUTA_APP;
    $html = "";
    if ($app->usuarioLogueado()) {
        $html .= "<a href='{$rutaApp}/micuenta.php'> {$app->nombreUsuario()} <i class='fa-solid fa-circle-user'></i></a> ";
        $html .= "<a href='{$rutaApp}/logout.php'><i class='fa-solid fa-right-from-bracket'></i></a>";
    } else {
        $html .= "<a href='{$rutaApp}/login.php#'><i class='fa-solid fa-door-open'></i> Login/Registro</a>";
    }
    return $html;
}

/**
 * Devuelve html que identifica a un usuario premium o estandar
 * @return html
 */
function isPremium() {
    $app = Aplicacion::getInstance();
    $rutaApp = RUTA_APP;

    $html = "";
    if ($app->usuarioLogueado() && !$app->esAdmin() && !$app->esProfesional()) {
        $html .= "<h4>";
        if ($app->esPremium()) {
            $html .= "Premium";
        } else {
            $html .= "<a href='{$rutaApp}/suscripcion.php'>¡Hazte premium!</a>";
        }
        $html .= "</h4>";
    }
    return $html;
}
?> 

<header>
    <div class="logo">
        <h1>Lifety</h1>
    </div>

    <div class="saludo">
        <?= isPremium() ?>
        <?= mostrarSaludo() ?>
    </div>
</header>