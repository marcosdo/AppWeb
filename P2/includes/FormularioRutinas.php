<?php
namespace es\ucm\fdi\aw;

class FormularioRutinas extends Formulario {
    public function __construct() {
        parent::__construct('formRutinas', ['urlRedireccion' => 'tablaRutina.php']);
    }
    
    protected function generaCamposFormulario(&$datos) {
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['dias', 'objetivo', 'rutina'], $this->errores, 'span', array('class' => 'error'));


        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset> 
            <legend id="routine-plan">Rutinas</legend>
            <form method="post" action="planificacionrutinas.php">
            <p> Selecciona tu nivel: </p>
            <p>
                <input type= "radio" name="nivel" value="P" checked>Principiante
                <input type= "radio" name="nivel" value="M">Medio
                <input type= "radio" name="nivel" value="A">Avanzada
            </p>
            <p>
                <select name="dias" id="choose-days">
                    <option value="3">3 Días</option>
                    <option value="5">5 Días</option>
                </select >
            </p>
            <p>
                <select name="rutina" id="choose-routine">
                    <option value="1">Fuerza</option>
                    <option value="2">Hipertrofia</option>
                    <option value="3">Resistencia</option>
                </select >
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
                <input type="submit" name="enviar" value ="Quiero esta rutina" class="send-button">
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
        // nivel = CHAR: ['P', 'M', 'A']
        htmlspecialchars(trim(strip_tags($_POST["nivel"])));
        // rutina = INT: [1, 2, 3]
        htmlspecialchars(trim(strip_tags($_POST["rutina"])));
        // dias = INT: [3, 5]
        htmlspecialchars(trim(strip_tags($_POST["dias"])));
        // Si los datos existen los mete en variables
        $nivel      = isset($_POST["nivel"])    ? $_POST["nivel"]   : null;
        $objetivo   = isset($_POST["rutina"])   ? $_POST["rutina"]  : null;
        $dias       = isset($_POST["dias"])     ? $_POST["dias"]    : null;

        if ($objetivo != '1' && $objetivo != '2' && $objetivo != '3') 
            $this->errores['objetivo'] = 'El objetivo no es válido.';
        if($nivel != 'P' && $nivel != 'M' && $nivel != 'A')
            $this->errores['nivel'] = 'El nivel no es válido.';
        if($dias != '3' && $dias != '5')
            $this->errores['dias'] = 'El dia no es válido.';
                
        if (count($this->errores) === 0) {
            //$rutina = new Rutina ("titofloren", $objetivo, $nivel, $dias);
         Rutina::comprobarRutina("titofloren", $objetivo, $nivel, $dias);
        }
    }
}
