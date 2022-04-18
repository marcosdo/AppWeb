<?php
use appweb\Aplicacion;
use appweb\foro\Foro;

/**
 * @return
 */
function muestraTemas() {
    $app = Aplicacion::getInstance();
    // Coger todas las filas de foro
    $data = Foro::getData();
    $tema = array_column($data, 'tema');
    $idforo = array_column($data, 'id_foro');

    $html = "<div class=temas><h3>Lista de temas</h3>";
    for ($i = 0; $i < count($data); $i++) {
        // Busca el foro
        $foro = Foro::buscaxID($idforo[$i]);
        $formBorraForo = new appweb\foro\FormularioBorraForo($idforo[$i]);
        $boton = $formBorraForo->gestiona();
        if ($app->usuarioLogueado() && ($app->idUsuario() == $foro->getIDUsuario()) || $app->esAdmin())
            $aux = $boton;
        else $aux = ""; 
        $html .= "<li>";
        $html .= "<a href='foroaux.php?idforo={$idforo[$i]}'>{$tema[$i]}</a>";
        $html .= "$aux";
        $html .= "</li>";
    }
    $html .= "</div>";

    return $html;
}