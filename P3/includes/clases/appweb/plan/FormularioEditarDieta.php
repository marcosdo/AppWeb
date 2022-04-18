<?php
namespace appweb\plan;

use appweb\Formulario;
use appweb\Aplicacion;

class FormularioEditarDieta extends Formulario {
    public function __construct() {
        parent::__construct('formEditarDietas', ['urlRedireccion' => 'entrenadorplan.php']);
    }
    
    private function comidas ($defecto, $tipo){
        $rts = "";
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM comidas WHERE comidas.tipo = '%s'", $tipo); 
        $rs = $conn->query($query); 
        while($fila = $rs->fetch_assoc()){
            if($defecto == $fila['descripcion']){
                $rts .= "<option value='$fila[descripcion]' selected>$fila[descripcion]</option>";
            }
            else
                $rts .= "<option value='$fila[descripcion]'>$fila[descripcion]</option>";
        }
        $rs->free();
        return $rts;
    }

    private function idUsuario(&$alias){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM entrena WHERE entrena.editadieta = '%d'",1); 
        $rs = $conn->query($query); 
        $fila = $rs->fetch_assoc();
        $alias =  $fila['usuario'];
        $query2 = sprintf("SELECT * FROM personas WHERE personas.nick = '%s'", $alias);
        $rs2 = $conn->query($query2); 
        $fila2 = $rs2->fetch_assoc();
        return $fila2['id_usuario'];
    }

    private function generaTabla(){
        $dias = 0;
        $alias = "";
        $idusuario = self::idUsuario($alias);
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
        $conn = Aplicacion::getInstance()->getConexionBd();

        if (count($this->errores) === 0) {

            $dias = 0;
            $alias = "";
            $idusuario = self::idUsuario($alias);
            $desayuno = array();
            $almuerzo = array();
            $cena = array();
            $fecha = Dieta:: buscaDieta($idusuario, $dias, $desayuno, $almuerzo, $cena);
            $fechaini = $fecha;

            for ($i = 0; $i < 3; $i++) {
                $fecha = $fechaini;
                for ($j = 0; $j < $dias;$j++) { 
                    
                    switch ($i) {
                        case 0: 
                        $defecto = $desayuno[$j];
                        break;
                        case 1: 
                        $defecto = $almuerzo[$j]; 
                        break;
                        case 2: 
                        $defecto = $cena[$j]; 
                        break;
                        default: break;
                    }
                    $query = sprintf("SELECT * FROM dieta WHERE dieta.id_usuario = '%d'", $idusuario); 
                    $rs = $conn->query($query); 
                    $diaspos = $i;
                    $diaspos .= "-";
                    $diaspos .= $j;
                    $select = $datos[$diaspos];
                    if($defecto != $select){ // Se cambia el ejercicio
                        $queryaux = sprintf("SELECT * FROM comidas WHERE comidas.descripcion = '%s'", $select); 
                        $rsaux = $conn->query($queryaux); 
                        $filaaux = $rsaux->fetch_assoc();
                        $idc = $filaaux['id_comida'];
                        switch ($i){
                            case 0: 
                                $query2 = sprintf("UPDATE dieta SET dieta.id_desayuno = '%d' WHERE dieta.id_usuario = '%d' AND dieta.fecha = '%s'", $idc, $idusuario, $fecha);
                                break;
                            case 1: 
                                $query2 = sprintf("UPDATE dieta SET dieta.id_almuerzo = '%d' WHERE dieta.id_usuario = '%d' AND dieta.fecha = '%s'", $idc, $idusuario, $fecha);
                                break;
                            case 2: 
                                $query2 = sprintf("UPDATE dieta SET dieta.id_cena = '%d' WHERE dieta.id_usuario = '%d' AND dieta.fecha = '%s'", $idc, $idusuario, $fecha);
                                break;
                                default: break;
                        }
                        $actualizacontiene = $conn->query($query2); 
  
                    }
                    $fecha = date('Y-m-d', strtotime($fecha . '+1 day'));
                }
            }
            $queryeditar = sprintf("UPDATE entrena SET entrena.editadieta = '%d' WHERE entrena.usuario = '%s'", 0, $alias); 
            $actualizadieta = $conn->query($queryeditar);
        }
        

    }
}
