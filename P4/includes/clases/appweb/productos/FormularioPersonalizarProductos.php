<?php

namespace appweb\productos;

use appweb\Aplicacion;
use appweb\Formulario;

class FormularioPersonalizarProdutos extends Formulario {

    public function __construct() {
        parent::__construct('formPersProductos', ['class' => 'inline', 'urlRedireccion' => 'tienda.php']);
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

    protected function generaCamposFormulario(&$datos) {
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['dias', 'objetivo', 'nivel', 'ver'], $this->errores, 'span', array('class' => 'error'));
  
        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        if(isset($_SESSION['id'])){
            $boton = "<button type='submit' name='enviar'>Ver mis productos recomendados</button>";
        }
        else{
            $boton = "<button type='submit' name='enviar'>Filtrar productos</button>";

        }


        $camposFormulario = <<<EOF
        $htmlErroresGlobales
        <p> Selecciona tu nivel: </p>
        <input name = "precio" id = "choose-precio" type="range">
        
        <p class="error">{$erroresCampos['precio']}</p>
    
        <select name="empresa" id="choose-empresa" required>
            
        </select >
        <p class="error">{$erroresCampos['empresa']}</p>
        
        <select name="tipo" id="choose-tipo" required>
            
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
        $this->errores = [];
        $app = Aplicacion::getInstance();

       
        if (count($this->errores) === 0) {


        }
            
    }
}
