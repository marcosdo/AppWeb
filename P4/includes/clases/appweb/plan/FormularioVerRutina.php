<?php
namespace appweb\plan;

use appweb\Formulario;
use appweb\Aplicacion;

class FormularioVerRutina extends Formulario {
    public function __construct() {
        parent::__construct('formVerRutina', ['urlRedireccion' => 'planrutina.php']);
    }
    

    protected function generaCamposFormulario(&$datos) {
        
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $app = Aplicacion::getInstance();
        $hayRutinas = Rutina::hayRutinas($app->idUsuario());
        if($hayRutinas) {
            $boton = "<p> Pulsa aqui si quieres ver tu rutina </p>";
            $boton .= "<div><button type='submit' name='enviar'>Ver Mi Rutina</button></div>";
        }
        else{
            $boton = "No tienes ninguna rutina, ¡personalizate una desde Crear Plan!";
        }


        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset id ="formverdieta"> 
            <legend id="ver-routine-plan">Ver Rutina</legend>
        $boton
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
    }
}
