<?php
namespace appweb\plan;

use appweb\Formulario;
use appweb\Aplicacion;
use appweb\plan\Dieta;


class FormularioEditarDieta extends Formulario {
    public function __construct() {
        parent::__construct('formEditarDietas', ['urlRedireccion' => 'entrenadorplan.php']);
    }
    
    private function comidas ($defecto, $tipo){
        $comidas = Dieta::getComidas($tipo);
        $rts = "";
        foreach ($comidas as &$valor) {
            if($defecto == $valor){
                $rts .= "<option value='$valor' selected>$valor</option>";
            }
            else
                $rts .= "<option value='$valor'>$valor</option>";
        }
        return $rts;
    }

    private function generaTabla(){
        $dias = 0;
        $alias = "";
        $idusuario = Dieta::usuarioEditarRutina($alias);
        $desayuno = array();
        $almuerzo = array();
        $cena = array();
        $fecha = Dieta:: buscaDieta($idusuario, $dias, $desayuno, $almuerzo, $cena);

        $contenido = "<table id=planificacion>";
        $contenido .= "<caption>Dieta especializada</caption>";
        $contenido .= "<thead><tr>";
        // Dias de la semana 
        $contenido .= "<th></th>";
        for ($i = 0; $i < $dias; $i++) { 
            $dia_semana = date('w', strtotime($fecha));
            $dia_mes = date('d', strtotime($fecha));
            switch ($dia_semana) {
                case 1: { $contenido .= "<th>L ".$dia_mes."</th>";   } break;
                case 2: { $contenido .= "<th>M ".$dia_mes."</th>";   } break;
                case 3: { $contenido .= "<th>X ".$dia_mes."</th>";   } break;
                case 4: { $contenido .= "<th>J ".$dia_mes."</th>";   } break;
                case 5: { $contenido .= "<th>V ".$dia_mes."</th>";   } break;
                case 6: { $contenido .= "<th>S ".$dia_mes."</th>";   } break;
                case 0: { $contenido .= "<th>D ".$dia_mes."</th>";   } break;
                default: break;
            }
            $fecha = date('Y-m-d', strtotime($fecha . '+1 day'));
        }
        $contenido .= "</tr></thead><tbody>";
        for ($i = 0; $i < 3; $i++) {
            $contenido .= "<tr>";
            switch ($i) {
                case 0: $contenido .= "<td id=\"table-diets\">Desayuno</td>";  break;
                case 1: $contenido .= "<td id=\"table-diets\">Comida</td>";    break;
                case 2: $contenido .= "<td id=\"table-diets\">Cena</td>";      break;
                default: break;
            }
            for ($j = 0; $j < $dias; $j++) {
                switch ($i) {
                    case 0: 
                    $defecto = $desayuno[$j];
                    $tipo = "Desayuno"; 
                    break;
                    case 1: 
                    $defecto = $almuerzo[$j]; 
                    $tipo = "Comida";
                    break;
                    case 2: 
                    $defecto = $cena[$j]; 
                    $tipo = "Cena";
                    break;
                    default: break;
                }
                $comidastipo = self::comidas($defecto, $tipo);
                $diaspos = $i;
                $diaspos .= "-";
                $diaspos .= $j;
                $select = "<select name=$diaspos id=$diaspos>";
                $select .= $comidastipo;
                $select .= "</select";
                $contenido .= "<td> $select</td>";
            }
            $contenido .= "</tr>";
        }
        $contenido .= "</tbody></table>"; 
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
        <div>
        $contenido
        </div>
        {$erroresCampos['alias']}
        <div>
        <button type="submit" name="enviar">Editar dieta</button>
        </div>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {

        if (count($this->errores) === 0) {
            Dieta::editarDieta($datos);
        }
        

    }
}
