<?php
namespace appweb\plan;

use appweb\Formulario;
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
        $conn = $app->getConexionBd();
        $query = sprintf("SELECT * FROM dieta WHERE dieta.id_usuario = '%s'", $app->idUsuario()); 
        $rs = $conn->query($query);
        if($rs->num_rows > 0) {
            $boton = "<p> Pulsa aqui si quieres ver tu dieta </p>";
            $boton .= "<div><button type='submit' name='enviar'>Ver Mi Dieta</button></div>";
        }
        else{
            $boton = "No tienes ninguna dieta, ¡personalizate una desde Crear Plan!";
        }


        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset id ="formverdieta"> 
            <legend id="ver-dieta-plan">Ver Dieta</legend>
        $boton
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
    }
}
