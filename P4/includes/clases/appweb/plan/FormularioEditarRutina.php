<?php
namespace appweb\plan;


use appweb\Formulario;
use appweb\plan\Rutina;
use appweb\contenido\Ejercicios;


class FormularioEditarRutina extends Formulario {
    private $idUsuario;

    public function __construct($idUsuario) {
        $this->idUsuario = $idUsuario;
        parent::__construct('formEditarRutinas', ['urlRedireccion' => 'entrenadorplan.php']);
    }
    private function selectEjercicios($defecto){
        $html = "";
        $ejercicios = Ejercicios::getEjercicios();
        if($defecto == "")
            $html .= "<option value='' selected>Agregar ejercicio</option>";
        foreach ($ejercicios as &$valor) {
            if($defecto == $valor)
                $html .= "<option value='$valor' selected>$valor</option>";
            else
                $html .= "<option value='$valor'>$valor</option>";
        }
        return $html;
    }

    private function generaTabla(){
        $alias = "";

        $contenido = "<table id=planificacion>";
        $obj = 0;
        $arrayreps = [];
        $arrayids = [];

        $idRutina = Rutina::getRutinaActiva($this->idUsuario);
        $arrayaux = Rutina::buscaRutina($obj, $arrayreps, $idRutina, $arrayids);
        $ejerciciostotales = 0;
        for($d = 0; $d < count($arrayaux); $d++){
            $aux = count($arrayaux [$d]);
            if($aux > $ejerciciostotales) $ejerciciostotales = $aux; 

        }
        $contenido .= "<caption>Rutina de entrenamiento</caption><thead><tr>";

        for ($i = 1; $i < count($arrayaux)+1;$i++){
            $contenido .= "<th>Día $i </th>";
        }
        $contenido .= "</tr></thead><tbody>";
        for ($i = 0; $i <= $ejerciciostotales;$i++){
            $contenido .= "<tr>";
            for ($j = 0; $j < count($arrayaux)  ; $j++) { 
                $defecto = isset($arrayaux[$j][$i]) ? $arrayaux[$j][$i] : ""; 
                $ejercicios = self::selectEjercicios($defecto);
                $diaspos = $j;
                $diaspos .= "-";
                $diaspos .= $i;
                $select = "<select name=$diaspos id=$diaspos>";
                $select .= $ejercicios;
                $select .= "</select";
                $contenido .= "<td> $select</td>";
                
                
            }
            $contenido .= "</tr>";
        }
        $series = "</tbody><div id= repeticiones>";
        $series .= "<p> Nº de series: 3 </p> </div>";
        $contenido .= "</table>";
        
        return $contenido;
        
    }
    
    protected function generaCamposFormulario(&$datos) {
        $alias = $datos['alias'] ?? '';
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['alias'], $this->errores, 'span', array('class' => 'error'));


        $contenido = self::generaTabla();
        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
                    
        $contenido
        
        {$erroresCampos['alias']}
        
        <button type="submit" name="enviar">Editar rutina</button>
                    
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {

        if (count($this->errores) === 0) {
            Rutina::editarRutina($datos, $this->idUsuario);
        }
        

    }
}
