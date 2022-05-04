<?php
namespace appweb\plan;

use appweb\Formulario;
use appweb\Aplicacion;
use appweb\plan\Rutina;


class FormularioVerRutina extends Formulario {
    public function __construct() {
        parent::__construct('formVerRutina', ['urlRedireccion' => 'planrutina.php']);
    }
    

    private function mostrarRutinas($app){
        $rutinas = Rutina::getRutinas($app->idUsuario(), $app);
        $contador = 1;
        $values = "";
        $select = "<select name=rutina id=selectrutina>";
        
        foreach($rutinas as $rutina){
            $caracteristicas = self::parametrosRutina($rutina);
            $idRutina = $rutina["id_rutina"];
            $values .= "<option value='$idRutina' selected>Rutina $contador - $caracteristicas</option>";
            $contador++;
        }
        $select .= $values;
        $select .= "</select";        
        return $select;
    }

    private function parametrosRutina($rutina){
        $caracteristicas = "Objetivo ";
        switch($rutina["objetivo"]){
            case 1: $caracteristicas .= "Fuerza, "; break;
            case 2: $caracteristicas .= "Hipertrofia, "; break;
            case 3: $caracteristicas .= "Resistencia, "; break;
        }
        $caracteristicas .= " nivel ";
        switch($rutina["nivel"]){
            case "A": $caracteristicas .= "Avanzado, "; break;
            case "M": $caracteristicas .= "Medio, "; break;
            case "P": $caracteristicas .= "Principiante, "; break;
        }
        switch($rutina["dias"]){
            case 3: $caracteristicas .= "3 dias."; break;
            case 5: $caracteristicas .= "5 dias."; break;
        }
        return $caracteristicas;

    }


    protected function generaCamposFormulario(&$datos) {
        
        $rutina = $datos['rutina'] ?? '';
        
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['rutina'], $this->errores, 'span', array('class' => 'error'));
        // Se generan los mensajes de error si existen.
        $app = Aplicacion::getInstance();
        $hayRutinas = Rutina::hayRutinas($app->idUsuario(), $app);
        if($hayRutinas) {
            $htmls = "<p> Selecciona la rutina que quieres ver </p>";

            $htmls .= self:: mostrarRutinas($app);
            

            $boton = "<div class =button><button type='submit' name='enviar'>Ver Mi Rutina</button></div>";
        }
        else{
            $htmls = "No tienes ninguna rutina, ¡personalizate una desde Crear Plan!";
            $boton = "";
        }


        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset id ="formverrutina"> 
            <legend id="ver-routine-plan">Ver Rutinas</legend>
        $htmls
        $boton
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        $this->errores = [];
        htmlspecialchars(trim(strip_tags($_POST["rutina"])));
        $rutina = trim($datos["rutina"] ?? '');

        if (count($this->errores) === 0) {
            $app = Aplicacion::getInstance();
            $this->urlRedireccion = $app->buildUrl('/planrutina.php', ['idRutina' => $rutina]);
            
        }
    }
}
