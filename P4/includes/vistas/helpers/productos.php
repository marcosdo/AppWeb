<?php
use appweb\productos\Productos;

/**
 * 
 * @return html
 */
function listaProductos() {
    $ids = array();
    $nombres = array();
    $empresa = array();
    $descripcion = array();
    $precio = array();
    $link = array();
    $tipo = array(); 
    Productos::getProductos($ids, $nombres, $empresa, $descripcion, $precio, $link, $tipo);
    $html = "<div class ='productos'>";
    $ruta = RUTA_IMGS;

    for($i = 0; $i < count($nombres); $i++){
        $productoi = "<div class ='row-productos'>";
        $productoi .= "<h1 class='nombre-producto'>$nombres[$i]</h1>";
        $productoi .= "<h3>De $empresa[$i]</h3>";

        $productoi .= "<img src='$ruta/productos/$ids[$i].png' alt=$nombres[$i]>";
        
        $productoi .= "<h3>$precio[$i]</h3>";
        $productoi .= "<h3>$tipo[$i]</h3>";

        $productoi .= "<h3>$descripcion[$i]</h3>";
        $productoi .= "<h3>Para comprar: $link[$i]</h3>";

        $productoi .= "</div>";
        $html .= $productoi;
    }
    
    $html .= "</div>";
    return $html;
}

