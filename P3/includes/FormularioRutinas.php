<?php
namespace es\ucm\fdi\aw;

class FormularioRutinas extends Formulario {
    public function __construct() {
        parent::__construct('formRutinas', ['urlRedireccion' => 'planrutina.php']);//cambiar
    }
    
    protected function generaCamposFormulario(&$datos) {
        $dias = $datos['dias'] ?? '';
        $objetivo = $datos['objetivo'] ?? '';
        $nivel = $datos['nivel'] ?? '';
        
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['dias', 'objetivo', 'nivel'], $this->errores, 'span', array('class' => 'error'));


        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset id ="formrutina"> 
            <legend id="routine-plan">Rutinas</legend>
            <div>
                <p> Selecciona tu nivel: </p>
                    <div>
                        <input type= "radio" name="nivel" value="P" checked> <label for="principiante"> Principiante </label>
                    </div>
                    <div>
                        <input type= "radio" name="nivel" value="M"> <label for="medio"> Medio </label>
                    </div>
                    <div>
                        <input type= "radio" name="nivel" value="A"> <label for="avanzado"> Avanzado </label>
                    </div>
                    {$erroresCampos['nivel']}
                <div>
                    <p> Selecciona el numero de dias: <p>
                    <select name="dias" id="choose-days">
                        <option value="3">3 Días</option>
                        <option value="5">5 Días</option>
                    </select >
                    {$erroresCampos['dias']}
                </div>
                <div>
                    <p> Selecciona tu objetivo de entrenamiento: <p>
                    <select name="objetivo" id="choose-routine">
                        <option value="1">Fuerza</option>
                        <option value="2">Hipertrofia</option>
                        <option value="3">Resistencia</option>
                    </select>
                    {$erroresCampos['objetivo']}
                </div>
                <p>
                La actividad física regular puede mejorar la fuerza muscular y 
                aumentar la resistencia. El ejercicio suministra oxígeno y nutrientes a 
                los tejidos y ayuda a que el sistema cardiovascular funcione de manera más eficiente. Y cuando tu salud cardíaca y 
                pulmonar mejora, tienes más energía para hacer las tareas diarias.
                </p>
                <button type="submit" name="enviar">Quiero esta rutina</button>
            </div>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        /* === ERRORES ===
        dieta != [1, 2, 3]
        =============== */
        $this->errores = [];
        // nivel = CHAR: ['P', 'M', 'A']
        htmlspecialchars(trim(strip_tags($_POST["nivel"])));
        // objetivo = INT: [1, 2, 3]
        htmlspecialchars(trim(strip_tags($_POST["objetivo"])));
        // dias = INT: [3, 5]
        htmlspecialchars(trim(strip_tags($_POST["dias"])));

        $nivel      = trim($datos["nivel"] ?? '');
        $objetivo   = trim($datos["objetivo"] ?? '');
        $dias       = trim($datos["dias"] ?? '');
        if ($objetivo != '1' && $objetivo != '2' && $objetivo != '3') 
            $this->errores['objetivo'] = 'El objetivo no es válido.';
        if($nivel != 'P' && $nivel != 'M' && $nivel != 'A')
            $this->errores['nivel'] = 'El nivel no es válido.';
        if($dias != '3' && $dias != '5')
            $this->errores['dias'] = 'El dia no es válido.';
                
        if (count($this->errores) === 0) {
            $rutina = new Rutina ($_SESSION['id'], $objetivo, $nivel, $dias);
            $rutina->comprobarRutina();
        }
    }
}
