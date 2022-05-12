<?php

namespace appweb\contenido;

use appweb\contenido\Comidas;
use appweb\Aplicacion;
use appweb\Formulario;

class FormularioFiltrarRecetas extends Formulario {

    public function __construct() {
        parent::__construct('formFilRecetas', ['urlRedireccion' => 'recetas.php']);
    }

   
    protected function generaCamposFormulario(&$datos) {
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['objetivo', 'tipo', 'search'], $this->errores, 'span', array('class' => 'error'));
        $camposFormulario = <<<EOF
            <h3>Filtra entre las recetas que tenemos disponibles</h3>
            $htmlErroresGlobales
            <input id="search" type="text" name="search" placeholder="Buscar"/>
            <select name="objetivo" id="objetivo">
            <option value="" disabled="disabled" selected="selected">Selecciona el objetivo de nutricion</option>
            <option value="1">Pérdida de peso</option>
            <option value="2">Ganancia de peso</option>
            <option value="3">Mantener peso</option>
            </select>
            {$erroresCampos['objetivo']}
            <select name="tipo" id="tipo">
            <option value="" disabled="disabled" selected="selected">Selecciona el tipo de comida</option>
            <option value="Desayuno">Desayuno</option>
            <option value="Comida">Comida</option>
            <option value="Cena">Cena</option>
            </select>
            {$erroresCampos['tipo']}
            <button type="submit" name="filtrar">Filtrar</button>
        EOF;
        return $camposFormulario;
    }

    /** Procesa los datos del formulario. */
    protected function procesaFormulario(&$datos) {
        $this->errores = [];

        $tipo = trim($datos['tipo'] ?? '');
        $tipo = filter_var($tipo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(!empty($tipo))
            if ($tipo != "Desayuno" && $tipo != "Comida" && $tipo != "Cena" )
                $this->errores['tipo'] = 'Tipo invalido';

        $objetivo = trim($datos['objetivo'] ?? '');

        if(!empty($objetivo))
            if ($objetivo < 1 || $objetivo > 3)
                $this->errores['objetivo'] = 'Objetivo no encontrado';

                $objetivo = trim($datos['objetivo'] ?? '');

        $search = trim($datos['search'] ?? '');
        $search = filter_var($search, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        if(!empty($search))
            if(!$search) $this->errores['search'] = 'Busqueda incorrecta';

        if (count($this->errores) === 0) {
            $params = [
                "numPorPagina" => 3,
                "numPagina" => 1,
                "objetivo" => $objetivo,
                "tipo" => $tipo,
                "descripcion" => $search
            ];

            $url = "recetas.php?" . Aplicacion::buildParams($params);
            Aplicacion::redirige($url);
        }
    }
}