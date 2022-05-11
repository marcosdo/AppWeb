<?php

namespace appweb\contenido;

use appweb\Aplicacion;
use appweb\Formulario;

class FormularioFiltrarEjercicios extends Formulario {

    public function __construct() {
        parent::__construct('formFilEjercicios', ['urlRedireccion' => 'ejercicios.php']);
    }

   
    protected function generaCamposFormulario(&$datos){
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['musculo', 'tipo'], array('class' => 'error'));
        
        $camposFormulario = <<<EOF
            <h3>Filtra por ejercicios segun tus preferencias</h3>
            $htmlErroresGlobales
            <select name="tipo" id="tipo">
            <option value="" disabled="disabled" selected="selected">Selecciona el tipo de ejercicio</option>
            <option value="0">Basico</option>
            <option value="1">Normal</option>
            <option value="2">Alta repeticion</option>
            </select>
            {$erroresCampos['tipo']}
            <select name="musculo" id="musculo">
            <option value="" disabled="disabled" selected="selected">Selecciona el tipo de musculo</option>
            <option value="Hombro">Hombro</option>
            <option value="Pecho">Pecho</option>
            <option value="Espalda">Espalda</option>
            <option value="Triceps">Triceps</option>
            <option value="Biceps">Biceps</option>
            <option value="Pierna">Pierna</option>
            </select>
            {$erroresCampos['musculo']}
            <button type="submit" name="filtrar">Filtrar</button>
        EOF;
        return $camposFormulario;
    }

    /** Procesa los datos del formulario. */
    protected function procesaFormulario(&$datos) {
        $this->errores = [];

        $tipo = trim($datos['tipo'] ?? '');
        if(!empty($tipo)){
            if ($tipo < 1 || $tipo > 3)
                $this->errores['tipo'] = 'Tipo no encontrado';
        }

        $musculo = trim($datos['musculo'] ?? '');
        if(!empty($musculo)){
            if ($musculo != "Hombro" && $musculo != "Pecho" && $musculo != "Espalda" &&  $musculo != "Triceps" &&  $musculo != "Biceps" && $musculo != "Pierna")
            $this->errores['musculo'] = 'Musculo invalido';
        }

        
        if (count($this->errores) === 0) {
            $params = [
                "numPorPagina" => 9,
                "numPagina" => 1,
                "tipo" => $tipo,
                "musculo" => $musculo
            ];
           
            $url = "ejercicios.php?" . Aplicacion::buildParams($params);
            Aplicacion::redirige($url);
        }
    }
}