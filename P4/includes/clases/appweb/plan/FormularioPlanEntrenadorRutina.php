<?php
namespace appweb\plan;

use appweb\Formulario;
use appweb\Aplicacion;
use appweb\usuarios\Profesional;

class FormularioPlanEntrenadorRutina extends Formulario {
    public function __construct() {
        parent::__construct('formEntrenadorRutinas', ['urlRedireccion' => 'planeditarrutina.php']);
    }
    
    private function Usuarios(){
        $rts = "";
        $app = Aplicacion::getInstance();
        $usuarios = Profesional::getUsuariosRutina($app->nombreUsuario());
        foreach ($usuarios as &$valor) {
            $rts = $rts ."<option value='$valor'>$valor</option>";
        }
       return $rts;
    }

    protected function generaCamposFormulario(&$datos) {
        $alias = $datos['alias'] ?? '';
        
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['alias'], $this->errores, 'span', array('class' => 'error'));

        $app = Aplicacion::getInstance();

        $SelectUsuarios = self::Usuarios();
        $boton ="";
        if($SelectUsuarios == "") $Select = "<p>No hay usuarios disponibles.</p>";
        else {
            $Select = "<p>Selecciona el usuario<p><select name = 'alias' id = 'alias' type = 'text'>";
            $Select .= $SelectUsuarios;
            $Select .= "</select>";
            $boton = "<button type='submit' name='enviar'>Editar rutina</button>";
        }
        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        $Select
        {$erroresCampos['alias']}
        $boton
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        $this->errores = [];
        htmlspecialchars(trim(strip_tags($_POST["alias"])));
        $alias = trim($datos["alias"] ?? '');

        if (count($this->errores) === 0) {
            $conn = Aplicacion::getInstance()->getConexionBd();
            $queryr = sprintf("UPDATE entrena SET entrena.editarutina = '%d' WHERE entrena.usuario = '%s'",1, $alias); 
            $conn->query($queryr);
            
        }
    }
}
