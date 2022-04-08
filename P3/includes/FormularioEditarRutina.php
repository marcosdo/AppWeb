<?php
namespace es\ucm\fdi\aw;

class FormularioEditarRutina extends Formulario {
    public function __construct() {
        parent::__construct('formRutinas', ['urlRedireccion' => 'planrutinaent.php']);
    }
    
    private function Ejercicios(){
        $rts = "";
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM ejercicio"); 
        $rs = $conn->query($query); 
        while($fila = $rs->fetch_assoc()){
            $rts = $rts ."<option value='$fila[nombre]'>$fila[nombre]</option>";
        }
        $rs->free();
        return $rts;
    }
    
    protected function generaCamposFormulario(&$datos) {
        $alias = $datos['alias'] ?? '';
        $ejercicios = Ejercicios();
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['alias'], $this->errores, 'span', array('class' => 'error'));
    
        $SelectUsuarios = self::Usuarios($_SESSION['alias']);
        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset id ="formreditautina"> 
            <legend id="edit-routine-plan">Editor de Rutinas</legend>
            <p> Selecciona el usuario: </p>
                    <div>
                    <select name = 'alias' id = 'alias' type = 'text'>
                        $SelectUsuarios
                    </select>
                    </div>
                    {$erroresCampos['alias']}
                    <div>
                    <button type="submit" name="enviar">Editar rutina</button>
                    </div>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        $this->errores = [];
        htmlspecialchars(trim(strip_tags($_POST["alias"])));
        if ($objetivo != '1' && $objetivo != '2' && $objetivo != '3') 
            $this->errores['objetivo'] = 'El objetivo no es válido.';

        if (count($this->errores) === 0) {
            
        }

    }
}
