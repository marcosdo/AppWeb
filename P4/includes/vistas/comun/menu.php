<?php 
namespace appweb;
use appweb\usuarios\Personas;

/**
 * Devuelve el html necesario para hacer una lista con los .php a los que se puede ir segun las variables de sesion
 * @return html
 */
function htmlmenu() {
    $app = Aplicacion::getInstance();

    $html = "<li><a href=".RUTA_APP."/index.php>Portada</a></li>";

    if ($app->usuarioLogueado()) { 
        // Si eres admin
        if ($app->esAdmin()) {
            $html .= "<li><a href='admin.php'>Consola</a></li>";
            $html .= "<li><a href=".RUTA_APP."/foros.php>Foro</a></li>";
        }
        // Si eres usuario
        else if ($app->esUsuario()) {
            if ($app->esPremium()) 
                $html .= "<li><a href='chatusu.php'>Seguimiento</a></li>";
            else {
                $html .= "<li><a href='suscripcion.php'>Seguimiento</a></li>";
            }
            $html .= "<li><a href='verplan.php'>Ver Plan</a></li>";
            $html .= "<li><a href='plan.php'>Crear Plan</a></li>";
            $html .= "<li><a href=".RUTA_APP."/foros.php>Foro</a></li>";
            $html .= "<li><a href=".RUTA_APP."/contenido.php>Contenido</a></li>";
            $html .= "<li><a href=".RUTA_APP."/tienda.php>Productos</a></li>";
        }
        // Si eres profesional
        else if($app->esProfesional()) {
            $html .= "<li><a href='chatprof.php'>Chat</a></li>";
            $html .= "<li><a href='entrenadorplan.php'>Planificación</a></li>";
            $html .= "<li><a href=".RUTA_APP."/foros.php>Foro</a></li>";
            $html .= "<li><a href=".RUTA_APP."/contenido.php>Contenido</a></li>";
        }
    }
    return $html;
}
?>

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
                    <?php echo htmlmenu() ?>
                </ul>
            </div>
        </div>
    </div>
</nav>