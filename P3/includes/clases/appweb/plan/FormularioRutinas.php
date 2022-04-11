<?php
namespace appweb\plan;

use appweb\Formulario;

class FormularioRutinas extends Formulario {
    public function __construct() {
        parent::__construct('formRutinas', ['urlRedireccion' => 'planrutina.php']);
    }
    
    protected function generaCamposFormulario(&$datos) {
        $dias = $datos['dias'] ?? '';
        $objetivo = $datos['objetivo'] ?? '';
        $nivel = $datos['nivel'] ?? '';
        $ver = $datos['ver'] ?? '';
        
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['dias', 'objetivo', 'nivel', 'ver'], $this->errores, 'span', array('class' => 'error'));


        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        <p> Elija si quiere crear una rutina o ver la rutina actual: </p>
        <select name="ver" id="ver-rutina" required>
            <option value="0" selected="selected">Crear</option>
            <option value="1">Ver</option>
            </select>
        <p class="error">{$erroresCampos['ver']}</p>
        <p> Selecciona tu nivel: </p>
        <ul class="nivel">
            <li class="element">
                <input type= "radio" name="nivel" value="P" id="principiante" checked>
                <label for="principiante"> Principiante </label>
            </li>
            <li class="element">
                <input type= "radio" name="nivel" value="M" id="medio">
                <label for="medio"> Medio </label>
            </li>
            <li class="element">
                <input type= "radio" name="nivel" value="A" id="avanzado">
                <label for="avanzado"> Avanzado </label>
            </li>
        </ul>
        <p class="error">{$erroresCampos['nivel']}</p>
    
        <select name="dias" id="choose-days" required>
            <option value="" disabled="disabled" selected="selected">Selecciona el numero de dias</option>
            <option value="3">3 Días</option>
            <option value="5">5 Días</option>
        </select >
        <p class="error">{$erroresCampos['dias']}</p>
        
        <select name="objetivo" id="choose-routine" required>
            <option value="" disabled="disabled" selected="selected">Selecciona tu objetivo de entrenamiento</option>
            <option value="1">Fuerza</option>
            <option value="2">Hipertrofia</option>
            <option value="3">Resistencia</option>
        </select>
        <p class="error">{$erroresCampos['objetivo']}</p>
        <p>
        La actividad física regular puede mejorar la fuerza muscular y 
        aumentar la resistencia. El ejercicio suministra oxígeno y nutrientes a 
        los tejidos y ayuda a que el sistema cardiovascular funcione de manera más eficiente. Y cuando tu salud cardíaca y 
        pulmonar mejora, tienes más energía para hacer las tareas diarias.
        </p>
        <button type="submit" name="enviar">Ver rutina</button>
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
        // ver = INT: [0, 1]
        htmlspecialchars(trim(strip_tags($_POST["ver"])));


        $nivel      = trim($datos["nivel"] ?? '');
        $objetivo   = trim($datos["objetivo"] ?? '');
        $dias       = trim($datos["dias"] ?? '');
        $ver       = trim($datos["ver"] ?? '');

        if ($objetivo != '1' && $objetivo != '2' && $objetivo != '3') 
            $this->errores['objetivo'] = 'El objetivo no es válido.';
        if($nivel != 'P' && $nivel != 'M' && $nivel != 'A')
            $this->errores['nivel'] = 'El nivel no es válido.';
        if($dias != '3' && $dias != '5')
            $this->errores['dias'] = 'El dia no es válido.';
        if($ver != '0' && $ver != '1')
            $this->errores['ver'] = 'El parámetro de ver o crear no es válido.';  

        if (count($this->errores) === 0) {
            if($ver == 0){
                $rutina = Rutina::crea($_SESSION['id'], $objetivo, $nivel, $dias);
                $rutina->comprobarRutina($rutina);
            }
        }
    }
}
