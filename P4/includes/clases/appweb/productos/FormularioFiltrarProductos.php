<?php

namespace appweb\productos;

use appweb\productos\Productos;
use appweb\Aplicacion;
use appweb\Formulario;

class FormularioFiltrarProductos extends Formulario {

    public function __construct() {
        parent::__construct('formPersProductos', ['urlRedireccion' => 'tienda.php']);
    }

    /**
     * campos filtrar
     *  tipo (select)
     *  empresa (select)
     *  precio 
     * 
     *  si has iniciado sesion: 
     *  objetivodieta 
     *  objetivorutina
     *  nivel 
     * 
     *  si eres premium 
     *  peso
     *  altura
     *  imc
     */

    private function listaEmpresas(){
        $empresas = Productos::getEmpresas();
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
        $precio = $datos['precio'] ?? '';
        $empresa = $datos['empresa'] ?? '';
        $tipo = $datos['tipo'] ?? '';

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
            <p> Selecciona el precio maximo deseado </p>
            <input name="precio" id="choose-precio" type="range" min="0" max=$preciomaximo value="0"
                onchange="document.getElementById('outprecio').value=value">
            <output id="outprecio" name="outprecio" for ="precio">0</output>

            <p class="error">{$erroresCampos['precio']}</p>

            <select name="empresa" id="choose-empresa" required>
                $empresas
            </select>
            <p class="error">{$erroresCampos['empresa']}</p>

            <select name="tipo" id="choose-tipo" required>
                $tipos
            </select>
            <p class="error">{$erroresCampos['tipo']}</p>
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

        $empresa = trim($datos['empresa'] ?? '');
        $empresa = filter_var($empresa, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!array_search($empresa, Productos::getEmpresas()))
            $this->errores['empresa'] = 'Empresa no encontrada';

        $tipo = trim($datos['tipo'] ?? '');
        $tipo = filter_var($tipo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!array_search($empresa, Productos::getEmpresas()))
            $this->errores['tipo'] = 'Tipo no encontrado';

        if (count($this->errores) === 0) {
            $params = [
                "numPorPagina" => 9,
                "numPagina" => 1,
                "precio" => $precio,
                "empresa" => $empresa,
                "tipo" => $tipo
            ];
            $url = Aplicacion::buildParams($params);
            Aplicacion::redirige($url);
        }
    }
}