<?php
namespace es\ucm\fdi\aw;

class FromularioLogros extends Formulario {
    public function __construct() {
        parent::__construct('formLogros', ['urlRedireccion' => 'EntrenadorPersonalEnt.php']);
        
    }
    
    protected function generaCamposFormulario(&$datos) {
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['objetivo'], $this->errores, 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        /* === ERRORES ===
        dieta != [1, 2, 3]
        =============== 
        $this->errores = [];

        htmlspecialchars(trim(strip_tags($_POST["dieta"])));
        $objetivo = isset($_POST["dieta"]) ? $_POST["dieta"] : null;

        if ($objetivo == '1' || $objetivo == '2' || $objetivo == '3') 
            $this->errores['objetivo'] = 'El objetivo no es válido.';

        if (count($this->errores) === 0) {
            $BD = conectar_bd("localhost","root","","lifety");
            $desayunos_aux = array(); 
            $comidas_aux = array(); 
            $cenas_aux = array();
        }*/
    }
}
