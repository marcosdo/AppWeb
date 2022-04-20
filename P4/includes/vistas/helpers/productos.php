<?php
use appweb\productos\Productos;

/**
 * 
 * @return html
 */
function listaProductos() {
    Productos::getTodosProductos();

    $html = "A.";

    return $html;
}