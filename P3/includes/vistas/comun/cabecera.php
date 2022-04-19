<?php
/**
 * Devuelve el HTML necesario para mostrar la zona de inicio de sesion con las variables de sesion puestas
 * @return html 
 */
function mostrarSaludo() {
    $rutaApp = RUTA_APP;
    $html='';
    if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
        return "{$_SESSION['alias']} <a href='{$rutaApp}/logout.php'>(salir)</a>";
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