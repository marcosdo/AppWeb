<?php
namespace appweb;

class FormularioDietas extends Formulario {
    public function __construct() {
        parent::__construct('formDietas', ['urlRedireccion' => 'plandieta.php']);
    }
    
    protected function generaCamposFormulario(&$datos) {
        $objetivo = $datos['choose-diet'] ?? '';
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['objetivo-dieta'], $this->errores, 'span', array('class' => 'error'));


        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        <select name="choose-diet" id="choose-diet">
            <option value="" disabled="disabled" selected="selected">Selecciona tu dieta</option>
            <option value="1">Pérdida de peso</option>
            <option value="2">Ganancia de peso</option>
            <option value="3">Mantener peso</option>
        </select>
        {$erroresCampos['objetivo-dieta']}
        <p>
        Según la mayoría de los dietistas, no existen alimentos “malos”, sino dietas “poco sanas”. Una dieta saludable se consigue comiendo la cantidad correcta de alimentos en la proporción adecuada, con continuidad.
        Comer una proporción adecuada de alimentos de los principales grupos constituye la base del bienestar cotidiano, y reducirá el riesgo de enfermedades a largo plazo. 
        </p>
        <button type="submit" name="enviar">Quiero esta dieta</button>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        // Errores posibles
        $this->errores = [];
        // Comprueba que los datos no sean malignos
        $tipo_dieta = trim($datos['choose-diet'] ?? '');
        $tipo_dieta = filter_var($tipo_dieta, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // Lanza un error si hay datos malignos
        if (!$tipo_dieta || empty($tipo_dieta))
            $this->errores['objetivo-dieta'] = 'ERROR: procesa formulario de dietas. Caracteres malignos';

        /* === ERRORES ===
        dieta != {1, 2, 3}
        =============== */
        if (!$tipo_dieta == '1' || !$tipo_dieta == '2' || !$tipo_dieta == '3') 
            $this->errores['objetivo-dieta'] = 'ERROR: procesa formulario de dietas. Caracteres no esperados';

        // Si todo ha ido bien, 
        if (count($this->errores) === 0) {
            // Crea una instancia de dieta
            $class_dieta = Dieta::Dieta_ConstructorFalso($tipo_dieta);
            if (!$class_dieta)
                $this->errores['class-dieta'] = 'ERROR: procesa formulario de dietas. No se ha podido crear una dieta';
        }
    }
}
