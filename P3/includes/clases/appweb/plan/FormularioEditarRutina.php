<?php
namespace appweb\plan;

use appweb\Formulario;
use appweb\Aplicacion;

class FormularioEditarRutina extends Formulario {
    public function __construct() {
        parent::__construct('formEditarRutinas', ['urlRedireccion' => 'nutriplan.php']);
    }
    
    private function Ejercicios($defecto){
        $rts = "";
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM ejercicios"); 
        $rs = $conn->query($query); 
        while($fila = $rs->fetch_assoc()){
            if($defecto == $fila['nombre']){
                $rts .= "<option value='$fila[nombre]' selected>$fila[nombre]</option>";
            }
            else
                $rts .= "<option value='$fila[nombre]'>$fila[nombre]</option>";
        }
        $rs->free();
        return $rts;
    }

    private function idUsuario(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM rutina WHERE rutina.editar = '%d'",1); 
        $rs = $conn->query($query); 
        $fila = $rs->fetch_assoc();
        return $fila['id_usuario'];
    }

    private function generaTabla(){
        
        $idusuario = self::idUsuario();

        $contenido = "<table id=planificacion>";
        $obj = 0;
        $arrayreps = [];
        $arrayaux = Rutina::buscaRutina($obj, $arrayreps, $idusuario);
        $ejerciciostotales = count($arrayaux [count($arrayaux)-1]); // DIA 1 A 3 MISMOS EJERCICIOS DIA 4 A 5 MAS EJERCICIOS
        $contenido .= "<caption>Rutina de entrenamiento</caption><thead><tr>";

        for ($i = 1; $i < count($arrayaux)+1;$i++){ //nº de dias
            $contenido .= "<th>Día $i </th>";
        }
        $contenido .= "</tr></thead><tbody>";
        for ($i = 0; $i < $ejerciciostotales;$i++){
            $contenido .= "<tr>";
            for ($j = 0; $j < count($arrayaux)  ; $j++) { //nº de ejercicios al cabo del día
                $defecto = isset($arrayaux[$j][$i]) ? $arrayaux[$j][$i] : ""; //DIA 4 Y 5 HASTA 6 Y DIA 1 A 3 HASTA 4 EN NIVEL PRINCIPIANTE :)
                if($defecto != "") {
                    $b = count($arrayaux[$j]);
                    $ejercicios = self::Ejercicios($defecto);
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
        <fieldset id ="formeditrutina"> 
            <legend id="edit-routine-plan">Editor de Rutinas</legend>
                    <div>
                    $contenido
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
        $conn = Aplicacion::getInstance()->getConexionBd();

        if (count($this->errores) === 0) {

            $idusuario = self::idUsuario();
            $obj = 0;
            $arrayreps = [];
            $arrayaux = Rutina::buscaRutina($obj, $arrayreps, $idusuario);
            $ejerciciostotales = count($arrayaux [count($arrayaux)-1]);
            $dias = count($arrayaux);

            for ($i = 0; $i < $ejerciciostotales;$i++){
                for ($j = 0; $j < $dias;$j++) { 
                    $tabla = isset($arrayaux[$j][$i]) ? $arrayaux[$j][$i] : ""; //DIA 4 Y 5 HASTA 6 Y DIA 1 A 3 HASTA 4 EN NIVEL PRINCIPIANTE :)
                    $diaspos = $j;
                    $diaspos .= "-";
                    $diaspos .= $i;
                    if($tabla != "") $select = $datos[$diaspos];
                    else $select = $tabla;
                    if($tabla != $select){ // Se cambia el ejercicio
                        $query = sprintf("SELECT * FROM ejercicios");
                        $rs = $conn->query($query); 
                        while ($fila = $rs->fetch_assoc()){
                            if ($fila['nombre'] == $tabla) $antiguo = $fila['id_ejercicio'];
                            if ($fila['nombre'] == $select) $nuevo = $fila['id_ejercicio'];
                        }
                        $diaact = $j+1;
                        $query2 = sprintf("UPDATE contiene SET contiene.id_ejercicio = '%d' WHERE contiene.id_ejercicio = '%d' AND contiene.dia = '%d'", $nuevo, $antiguo, $diaact);
                        $actualizacontiene = $conn->query($query2); 
  
                    }
                }
            }
            $queryeditar = sprintf("UPDATE rutina SET rutina.editar = '%d' WHERE rutina.id_usuario = '%d' AND rutina.activa = '%d'", 0, $idusuario, 1); 
            $actualizarutina = $conn->query($queryeditar);
        }
        

    }
}
