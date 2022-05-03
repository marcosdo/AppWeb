<?php

namespace appweb\productos;

use appweb\productos\Productos;
use appweb\Aplicacion;
use appweb\Formulario;

class FormularioPersonalizarProductos extends Formulario {

    public function __construct() {
        parent::__construct('formPersProductos', ['urlRedireccion' => 'tiendapersonalizada.php']);
    }

    protected function generaCamposFormulario(&$datos) {

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
 
        $boton = "<button type='submit' name='enviar'>Ver productos personalizados</button>";

        $camposFormulario = <<<EOF
            <h2>Productos Personalizados</h2>
            $htmlErroresGlobales
            <p> Si quiere ver sus productos recomendados segun su planificación y seguimiento pulse el siguiente boton. </p>
            $boton
            <p></p>
        EOF;
        return $camposFormulario;
    }

    /** Procesa los datos del formulario. */
    protected function procesaFormulario(&$datos) {
        $this->errores = [];

        if (count($this->errores) === 0) {
            $app = Aplicacion::getInstance();
            Productos::personalizaProductos($app->idUsuario());
        }
    }
}