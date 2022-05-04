<?php
use appweb\Aplicacion;
use appweb\foro\Foro;

/**
 * Muestra los temas del foro y el boton de eliminar en funcion del tipo de usario que este logeado
 * @return html
 */
function muestraTemas() {
    $app = Aplicacion::getInstance();
    // Coger todas las filas de foro
    
    $enum = Foro::seleCategorias();
    $data = Foro::getData();

    $html = "<div class=temas>";
    $html .= "<h3>Lista de temas</h3>";
    for ($j = 0; $j < count($enum); $j++) {
        $tipo = array_column($data, 'categoria');
        $tema = array_column($data, 'tema');
        $idforo = array_column($data, 'id_foro');
        // Crear la variable html que devolvera el codigo
        $html .= "<h4>{$enum[$j]}</h4>";
        $html .= "<li>";
        for ($i = 0; $i < count($data); $i++) {
            if ($tipo[$i] == $enum[$j]) {
                // Busca el foro
                $foro = Foro::buscaxID($idforo[$i]);
                $formBorraForo = new appweb\foro\FormularioBorraForo($idforo[$i]);
                $boton = $formBorraForo->gestiona();
                // Mostrar el boton solo si es el creador o el admin
                if ($app->usuarioLogueado() && ($app->idUsuario() == $foro->getIDUsuario()) || $app->esAdmin())
                    $aux = $boton;
                else $aux = ""; 
                $html .= "<a href='foroindividual.php?idforo={$idforo[$i]}' class='listatemas'>{$tema[$i]}</a>";
                $html .= "$aux";
                
            }
        }
        $html .= "</li>";
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