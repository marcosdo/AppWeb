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
    
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM rutina WHERE rutina.id_usuario = '%s'", $_SESSION['id']); 
        $rs = $conn->query($query);
        if($rs->num_rows > 0) {
            $boton = "<div><button type='submit' name='enviar'>Ver Mi Rutina</button></div>";
        }
        else{
            $boton = "No tienes ninguna rutina, ¡personalizate una desde Crear Plan!";
        }


        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset id ="formreditautina"> 
            <legend id="edit-routine-plan">Ver mi Rutina</legend>
                    $boton
                    
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
    }
}
