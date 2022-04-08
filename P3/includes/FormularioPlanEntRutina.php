<?php
namespace es\ucm\fdi\aw;

class FormularioPlanEntRutina extends Formulario {
    public function __construct() {
        parent::__construct('formRutinas', ['urlRedireccion' => 'planrutinaent.php']);
    }
    
    private function Usuarios($entNombre){
        $rts = "";
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM entrena WHERE nutri = '%s'",$entNombre); 
        $rs = $conn->query($query); 
        while($fila = $rs->fetch_assoc()){
            $query2 = sprintf("SELECT * FROM usuario WHERE usuario = '%s'",$fila['usuario']);            
            $rs2 = $conn->query($query2); 
            $filausuario = $rs2->fetch_assoc();
            $query3 = sprintf("SELECT COUNT(*) FROM rutina WHERE id_usuario = '%s'",$filausuario['id_usuario']);          
            $rs3 = $conn->query($query3); 
            $row_cnt = $rs3->num_rows;
            if($row_cnt >0) $rts = $rts ."<option value='$fila[usuario]'>$fila[usuario]</option>";
        }

        $rs->free();
        return $rts;
    }

    protected function generaCamposFormulario(&$datos) {
        $alias = $datos['alias'] ?? '';
        
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
