<?php
// ==================== CONSTANTES ====================
// ====================            ====================
const NUTRI_ROLE = 1;
const USER_ROLE = 2;

// ==================== MÉTODOS ====================
// ====================         ====================

/**
 * Genera el html necesario para meter los errores globales en un elemento
 * @param array $errores array de errores generados
 */
function generaErroresGlobalesFormulario($errores) {
    $html = '';
    $keys = array_filter(array_keys($errores), function($v) {
        return is_numeric($v);
    });
    if (count($keys) > 0) {
        $html = '<ul class="errores">';
        foreach($keys as $key) {
            $html .= "<li>{$errores[$key]}</li>";
        }
        $html .= '</ul>';
    }
    return $html;
}

/**
 * Genera el html necesario para meter los errores particulares en un elemento
 * @param string     $campo nombre del error
 * @param array      $errores array de errores generados
 */
function generarError($campo, $errores) {
    return isset($errores[$campo]) ? "<span class=\"form-field-error\">{$errores[$campo]}</span>": '';
}

/**
 * Crea un componente html por cada campo que haya
 * @param string     $campo nombre del error
 * @param array      $errores array de errores generados
 */
function generaErroresCampos($campos, $errores) {
    $erroresCampos = [];
    foreach($campos as $campo) {
        $erroresCampos[$campo] = generarError($campo, $errores);
    }
    return $erroresCampos;
}