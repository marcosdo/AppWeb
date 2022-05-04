<?php

namespace appweb\productos;

use appweb\productos\Productos;
use appweb\Aplicacion;
use appweb\Formulario;

class FormularioPersonalizarProductos extends Formulario {

    public function __construct() {
        parent::__construct('formPersProductos', ['urlRedireccion' => 'tiendapersonalizada.php']);
    }

    private function comprobarPersonalizarProductos(){
        $app = Aplicacion::getInstance();
        $html = "";
        $ok = true;
        if(!Productos::haySeguimiento($app->idUsuario())){
            $html .= "<p>Necesita tener una asesoria para ver productos personalizados, registrate desde Seguimiento.</p>";
            $ok = false;
        }
        if(!Productos::hayRutina($app->idUsuario())){
            $html .= "<p>Hace falta una rutina para mostrar los productos personalizados, creala desde Crear Plan.</p>";
            $ok = false;
        }
        if(!Productos::hayDieta($app->idUsuario())){
            $html .= "<p>Es necesario tener una dieta para ver productos personalizados, creala desde Crear Plan.</p>";
            $ok = false;
        }

        if($ok){
            $html .= "<p> Si quiere ver sus productos recomendados segun su planificación y seguimiento pulse el siguiente boton. </p>";
            $html .= "<button type='submit' name='enviar'>Ver productos personalizados</button>";

        }
        
        return $html;
    }

    protected function generaCamposFormulario(&$datos) {

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
 
        
        $html = self::comprobarPersonalizarProductos();
        $camposFormulario = <<<EOF
            <h2>Productos Personalizados</h2>
            $htmlErroresGlobales
                $html
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