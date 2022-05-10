<?php

namespace appweb\productos;

use appweb\productos\Productos;
use appweb\Aplicacion;
use appweb\Formulario;

class FormularioFiltrarProductos extends Formulario {

    public function __construct() {
        parent::__construct('formFilProductos', ['urlRedireccion' => 'tienda.php']);
    }

    private function listaEmpresas(){
        $empresas = Productos::getNombresEmpresas();
        $html = "<option value='det' disabled='disabled' selected='selected'>Elige una empresa</option>";
        foreach ($empresas as &$valor) 
            $html .= "<option value='$valor'>$valor</option>";
            
        return $html;
    }

    private function tipoProductos() {
        $enum = Productos::getTipos();

        // Crear la variable html que devolvera el codigo
        $html = "<option value='det' disabled='disabled' selected='selected'>Filtre por tipo de producto</option>";
        for($i = 0; $i < sizeof($enum); $i++) {
            $html = $html . " <option value = '{$enum[$i]}'> {$enum[$i]} </option>";
        }
        return $html;
    }

    protected function generaCamposFormulario(&$datos) {
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['precio', 'empresa', 'tipo'], $this->errores, 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $empresas = self::listaEmpresas();
        $tipos = self::tipoProductos();
        $preciomaximo = Productos::getPrecioMaximo();
        $boton = "<button type='submit' name='enviar'>Filtrar productos</button>";

        $camposFormulario = <<<EOF
            $htmlErroresGlobales
            <h2>Filtrar Productos</h2>
            <p> Selecciona el precio maximo deseado </p>

            <p class="error">{$erroresCampos['precio']}</p>
            <input name="precio" id="choose-precio" type="range" min="0" max=$preciomaximo value="0"
                onchange="document.getElementById('outprecio').value=value">
            <output id="outprecio" name="outprecio" for ="precio">0</output>

            <p class="error">{$erroresCampos['tipo']}</p>
            <select name="tipo" id="choose-tipo" required>
                $tipos
            </select>

            <p class="error">{$erroresCampos['empresa']}</p>
            <p> Campo opcional <p>
            <select name="empresa" id="choose-empresa" required>
                $empresas
            </select>

            $boton
        EOF;
        return $camposFormulario;
    }

    /** Procesa los datos del formulario. */
    protected function procesaFormulario(&$datos) {
        $this->errores = [];

        $precio = trim($datos['precio'] ?? '');
        $precio = filter_var($precio, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($precio < 0 || $precio > Productos::getPrecioMaximo())
            $this->errores['precio'] = 'Precio invalido';

        $tipo = trim($datos['tipo'] ?? '');
        $tipo = filter_var($tipo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!in_array($tipo, Productos::getTipos()))
            $this->errores['tipo'] = 'Tipo no encontrado';

        $empresa = trim($datos['empresa'] ?? 'none');
        $empresa = filter_var($empresa, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($empresa != "none" && !in_array($empresa, Productos::getNombresEmpresas()))
                $this->errores['empresa'] = 'Empresa no encontrada';

        if (count($this->errores) === 0) {
            $params = [
                "numPorPagina" => 9,
                "numPagina" => 1,
                "precio" => $precio,
                "tipo" => $tipo
            ];
            if ($empresa != "none")
                $params["empresa"] = $empresa;

            $url = "tienda.php?" . Aplicacion::buildParams($params);
            Aplicacion::redirige($url);
        }
    }
}