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
    
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM dieta WHERE dieta.id_usuario = '%s'", $_SESSION['id']); 
        $rs = $conn->query($query);
        if($rs->num_rows > 0) {
            $boton = "<div><button type='submit' name='enviar'>Ver Mi Dieta</button></div>";
        }
        else{
            $boton = "No tienes ninguna dieta, ¡personalizate una desde Crear Plan!";
        }


        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset id ="formreditautina"> 
            <legend id="edit-routine-plan">Ver mi Dieta</legend>
                    $boton
                    
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
    }
}
