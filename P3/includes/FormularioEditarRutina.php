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

    private function generaTabla(){
        $id = Rutina::getIdEditar();
        $contenido = "<table id=planificacion>";
        $obj = 0;
        $arrayreps = [];
        $arrayaux = Rutina::buscaRutina($obj, $arrayreps, false);
        $ejerciciostotales = count($arrayaux [count($arrayaux)-1]); // DIA 1 A 3 MISMOS EJERCICIOS DIA 4 A 5 MAS EJERCICIOS
        $contenido .= "<caption>Rutina de entrenamiento</caption><thead><tr>";

        for ($i = 1; $i < count($arrayaux)+1;$i++){ //nº de dias
            $contenido .= "<th>Día $i </th>";
        }
        $contenido .= "</tr></thead><tbody>";
        for ($i = 0; $i < $ejerciciostotales;$i++){
            $contenido .= "<tr>";
            for ($j = 0; $j < count($arrayaux); $j++) { //nº de ejercicios al cabo del día
                $auxiliar = isset($arrayaux[$j][$i]) ? $arrayaux[$j][$i] : ""; //DIA 4 Y 5 HASTA 6 Y DIA 1 A 3 HASTA 4 EN NIVEL PRINCIPIANTE :)
                if(isset($arrayaux[$j][$i])) $auxiliar .= " x ";
                $auxiliar .= isset($arrayreps[$j][$i])  ? $arrayreps[$j][$i] : "";
                $contenido .= "<td> $auxiliar</td>";
            }
            $contenido .= "</tr>";
        }
        $series = "</tbody><div id= repeticiones>";
        $series .= "<p> Nº de series: 3 </p> </div>";
        $contenido .= "</table>";
        
    }
    
    protected function generaCamposFormulario(&$datos) {
        $alias = $datos['alias'] ?? '';
        $ejercicios = self::Ejercicios();
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['alias'], $this->errores, 'span', array('class' => 'error'));
        self::generaTabla();
        $SelectUsuarios = "";
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
        

    }
}
