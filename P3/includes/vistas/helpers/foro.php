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
function seleCategorias(){
    $rts ='';
    $rs = Foro::seleCategorias();
    $fila = $rs->fetch_assoc();
        $type = $fila['Type'];
        $matches = array();
        $enum = array();
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        $rts = $rts .   " <select name='categoria' id='categoria'>";
        for($i = 0; $i < sizeof($enum); $i++){
            $rts = $rts . " <option value = '{$enum[$i]}'> {$enum[$i]} </option>";
        }
        $rts = $rts . " </select>";
        return $rts;
}