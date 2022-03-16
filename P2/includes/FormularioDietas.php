<?php
namespace es\ucm\fdi\aw;

class FromularioDietas extends Formulario {
    public function __construct() {
        parent::__construct('formDietas', ['urlRedireccion' => 'Dieta.php']);
    }
    
    protected function generaCamposFormulario(&$datos) {
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['objetivo'], $this->errores, 'span', array('class' => 'error'));


        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset> 
            <legend id="diet-plan">Dietas</legend>
            <form method="post" action="planificaciondietas.php">
            <p>
                <select name="dieta" id="choose-diet">
                    <option value="1">Pérdida de peso</option>
                    <option value="2">Ganancia de peso</option>
                    <option value="3">Mantener peso</option>
                </select>
            </p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Quisque rutrum sit amet ipsum sed mollis. Praesent lectus 
                elit, pretium at condimentum in, elementum vitae lorem. 
                Quisque eget vulputate nunc. Donec lobortis at justo in 
                ornare. Duis lobortis magna justo, in finibus ipsum 
                ultricies nec. Donec efficitur purus quis venenatis 
                interdum. Aliquam cursus accumsan lacus, eget commodo nisi 
                blandit nec. Sed vitae maximus elit. Cras commodo magna 
                tortor, ut lobortis magna iaculis eget. 
            </p>
            <p>
                <input type="submit" name="enviar" value="Quiero esta dieta" class="send-button">
            </p>
            </form>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        /* === ERRORES ===
        dieta != [1, 2, 3]
        =============== */
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
        }
    }
}
