<?php

namespace appweb\productos;

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
     *  
     * 
     * 
     * 
     * 
     */

    private function listaEmpresas(){
        $empresas = Productos::getEmpresas();
        $html = "<option value='det' disabled='disabled' selected='selected'>Elige una empresa</option>";
        foreach ($empresas as &$valor) 
            $html .= "<option value='$valor'>$valor</option>";
            
        return $html;
    }

    private function tipoProductos(){
        $rs = Productos::getTipos();
        $fila = $rs->fetch_assoc();
        $type = $fila['Type'];
        $matches = array();
        $enum = array();
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
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
        
        $boton = "<button type='submit' name='enviar'>Filtrar productos</button>";

        

        $empresas = self::listaEmpresas();
        $tipos = self::tipoProductos();
        $preciomaximo = Productos::getPrecioMaximo();

        $camposFormulario = <<<EOF
        $htmlErroresGlobales
        <p> Selecciona el precio maximo deseado </p>
        <input name = "precio" id = "choose-precio" type="range" min = "0" max = $preciomaximo value = "0"
        onchange = "document.getElementById('outprecio').value=value">
        <output id="outprecio" name="outprecio" for ="precio">0</output>
        
        <p class="error">{$erroresCampos['precio']}</p>
    
        <select name="empresa" id="choose-empresa" required>
            $empresas
        </select >
        <p class="error">{$erroresCampos['empresa']}</p>
        
        <select name="tipo" id="choose-tipo" required>
            $tipos
        </select>
        <p class="error">{$erroresCampos['tipo']}</p>

        $boton
        EOF;        
        return $camposFormulario;
    }

    /**
     * Procesa los datos del formulario.
     */
    protected function procesaFormulario(&$datos)
    {

        htmlspecialchars(trim(strip_tags($_POST["precio"])));
        htmlspecialchars(trim(strip_tags($_POST["empresa"])));
        htmlspecialchars(trim(strip_tags($_POST["tipo"])));

        $precio      = trim($datos["precio"] ?? '');
        $empresa   = trim($datos["empresa"] ?? '');
        $tipo       = trim($datos["tipo"] ?? '');
       
        if (count($this->errores) === 0) {


        }
            
    }
}
