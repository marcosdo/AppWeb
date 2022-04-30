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
    $html = "<div class ='productos-layout'>";
    $ruta = RUTA_IMGS;

    for($i = 0; $i < count($nombres); $i++){
        $productoi = "<div class ='row-producto'>";
        $productoi .= "<h1 class='nombre-producto'>$nombres[$i]</h1>";
        $productoi .= "<div class ='imagen-producto'><img src='$ruta/productos/$ids[$i].png' alt=$nombres[$i]></div>";
        $productoi .= "<h3 class = 'descripcion-producto'>De $empresa[$i]. $descripcion[$i] Para comprar: $link[$i]</h3>";
        $productoi .= "<span class ='precio-producto'><h3>$precio[$i]€</h3></span>";

        $productoi .= "</div>";
        $html .= $productoi;
    }
    
    $html .= "</div>";
    return $html;
}

