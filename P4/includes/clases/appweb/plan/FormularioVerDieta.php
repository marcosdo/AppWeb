<?php
namespace appweb\plan;

use appweb\Formulario;
use appweb\plan\Dieta;
use appweb\Aplicacion;

class FormularioVerDieta extends Formulario {
    public function __construct() {
        parent::__construct('formVerDieta', ['urlRedireccion' => 'plandieta.php']);
    }

    protected function generaCamposFormulario(&$datos) {
        
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['alias'], $this->errores, 'span', array('class' => 'error'));
        $app = Aplicacion::getInstance();
        $hayDietas = Dieta::hayDietas($app->idUsuario());
        if($hayDietas) {
            $boton = "<p> Pulsa aqui si quieres ver tu dieta </p>";
            $boton .= "<div><button type='submit' name='enviar'>Ver Mi Dieta</button></div>";
        }
        else{
            $boton = "No tienes ninguna dieta, ¡personalizate una desde Crear Plan!";
        }


        $html = <<<EOF
        $htmlErroresGlobales
        <legend id="ver-dieta-plan">Ver Dietas</legend>
        $boton
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
    }
}
