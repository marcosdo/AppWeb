<?php
namespace es\ucm\fdi\aw;

class FormularioDietas extends Formulario {
    public function __construct() {
        parent::__construct('formDietas', ['urlRedireccion' => 'planificaciondietas.php']);
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
        // Errores posibles
        $this->errores = [];
        // Comprueba que los datos no sean malignos
        $tipo_dieta = htmlspecialchars(trim(strip_tags($datos['dieta'] ?? '')));
        $tipo_dieta = filter_var($tipo_dieta, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // Lanza un error si hay datos malignos
        if (!$tipo_dieta || empty($tipo_dieta))
            $this->errores['dieta'] = 'ERROR: procesa formulario de dietas. Caracteres malignos';

        /* === ERRORES ===
        dieta != {1, 2, 3}
        =============== */
        if ($tipo_dieta == '1' || $tipo_dieta == '2' || $tipo_dieta == '3') 
            $this->errores['objetivo-dieta'] = 'ERROR: procesa formulario de dietas. Caracteres no esperados';

        // Si todo ha ido bien, 
        if (count($this->errores) === 0) {
            $comidas = Dieta::exists_type($tipo_dieta);
            // Si comidas devuelve false
            if (!$comidas) {
                // Hay que crear una dieta nueva
                exit();
            }
            // Si no, hay que mostrar la que ya existe
        }
    }
}
