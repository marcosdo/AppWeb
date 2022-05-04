<?php
use appweb\Aplicacion;
use appweb\foro\Foro;
use appweb\foro\Mensaje;
use appweb\foro\FormularioBorraForo;

require_once __DIR__.'/mensajes.php';

/**
 * @param
 * @return html
 */
function muestraPrimerMensaje($idforo) {
    $msg = Mensaje::buscaPrimerMensajexIDForo($idforo);
    $html = visualizaMensajeObjeto($msg);
    return $html;
}

/**
 * Muestra los temas del foro y el boton de eliminar en funcion del tipo de usario que este logeado
 * @return html
 */
function muestraTemas() {
    $app = Aplicacion::getInstance();
    // Coger todas las filas de foro
    $enum = Foro::seleCategorias();
    // Generar <HTML>
    $html = "<div class='temas'>";
    $html .= "<h3>Lista de temas</h3>";
    for ($j = 0; $j < count($enum); $j++) {
        // Coge los datos de la BD
        $data = Foro::getDataxCategoria($enum[$j]) ?? array();
        $html .= "<div class='foro-temas'>";
        $html .= "<h4>{$enum[$j]}</h4>";
        // Por cada tema muestra una entrada diferente
        for ($i = 0; $i < count($data); $i++) {
            // Mostrar el boton solo si es el creador o el admin
            $url = "foroindividual.php?idforo={$data[$i]['id_foro']}";
            $html .= "<a href='{$url}' class='listatemas'>";
            $html .= "<h4>{$data[$i]['tema']}</h4>";
            $html .= muestraPrimerMensaje($data[$i]['id_foro']);
            $html .= "</a>";
            $boton = "";
            if ($app->idUsuario() == $data[$i]['id_usuario'] || $app->esAdmin()) {
                // Crea el formulario de borrar el foro
                $formBorraForo = new FormularioBorraForo($data[$i]['id_foro']);
                $boton = $formBorraForo->gestiona(); 
            }
            $html .= $boton;
        }
        $html .= "</div>"; 
    }
    $html .= "</div>"; 
    return $html;
}


/**
 * Muestra todos los temas posibles en un desplegable
 * @return html
 */
function seleCategorias(){
    // Coger del foro todas las categorias posibles
    $enum = Foro::seleCategorias();

    // Crear la variable html que devolvera el codigo
    $html = " <select name='categoria' id='categoria'>";
    for($i = 0; $i < sizeof($enum); $i++) {
        $html = $html . " <option value = '{$enum[$i]}'> {$enum[$i]} </option>";
    }
    $html = $html . " </select>";
    return $html;
}