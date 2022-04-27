<?php
namespace appweb\plan;


use appweb\Formulario;
use appweb\plan\Rutina;


class FormularioEditarRutina extends Formulario {
    public function __construct() {
        parent::__construct('formEditarRutinas', ['urlRedireccion' => 'entrenadorplan.php']);
    }
    private function selectEjercicios($defecto){
        $html = "";
        $ejercicios = Rutina::getEjercicios();
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
        $idusuario = Rutina::usuarioEditarRutina($alias);
        $contenido = "<table id=planificacion>";
        $obj = 0;
        $arrayreps = [];
        $arrayids = [];

        $arrayaux = Rutina::buscaRutina($obj, $arrayreps, $idusuario, $arrayids);
        $ejerciciostotales = count($arrayaux [count($arrayaux)-1]); 
        $contenido .= "<caption>Rutina de entrenamiento</caption><thead><tr>";

        for ($i = 1; $i < count($arrayaux)+1;$i++){
            $contenido .= "<th>Día $i </th>";
        }
        $contenido .= "</tr></thead><tbody>";
        for ($i = 0; $i < $ejerciciostotales;$i++){
            $contenido .= "<tr>";
            for ($j = 0; $j < count($arrayaux)  ; $j++) { 
                $defecto = isset($arrayaux[$j][$i]) ? $arrayaux[$j][$i] : ""; 
                if($defecto != "") {
                    $ejercicios = self::selectEjercicios($defecto);
                    $diaspos = $j;
                    $diaspos .= "-";
                    $diaspos .= $i;
                    $select = "<select name=$diaspos id=$diaspos>";
                    $select .= $ejercicios;
                    $select .= "</select";
                    $contenido .= "<td> $select</td>";
                }
                else {
                    $contenido .= "<td> </td>";
                }
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
            Rutina::editarRutina($datos);
        }
        

    }
}
