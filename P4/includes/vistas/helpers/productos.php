<?php
use appweb\productos\Productos;

/**
 * 
 * @return html
 */
function listaProductos() {
    Productos::getProductos();
    $html = "<br>Lista productos...";
    

    return $html;
}

