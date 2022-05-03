<?php
namespace appweb\admin;

use appweb\Formulario;
use appweb\productos\Productos;
use appweb\productos\Empresas;

class FormAdminCreaProducto extends Formulario {
    public function __construct() {
        parent::__construct('formAdminCreaProd', ['urlRedireccion' => 'adminproducto.php']);
    }
    
    private function listaEmpresas() {
        $empresas = Empresas::getData();
        $html = "<option value='det' disabled='disabled' selected='selected'>Empresa</option>";
        foreach ($empresas as $fila) {
            $id = $fila['id_empresa'];
            $name = $fila['nombre'];
            $html .= "<option value='{$id}'>{$id} - {$name}</option>";
        }
        return $html;
    }

    private function listaTipos() {
        $tipos = Productos::getTipos();
        $html = "<option value='det' disabled='disabled' selected='selected'>Tipo</option>";
        foreach ($tipos as &$value) {
            $html .= "<option value='$value'>$value</option>";
        }
        return $html;
    }

    protected function generaCamposFormulario(&$datos) {
        $idempresa = $datos['idempresa'] ?? '';
        $tipo = $datos['tipo'] ?? '';
        $nombre = $datos['nombre'] ?? '';
        $descipcion = $datos['descipcion'] ?? '';
        $precio = $datos['precio'] ?? '';
        $link = $datos['link'] ?? '';
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['idempresa', 'nombre', 'descipcion', 'precio', 'link', 'tipo'], $this->errores, 'span', array('class' => 'error'));

        $empresas = self::listaEmpresas();
        $tipos = self::listaTipos();
        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
            <h3>Inserta un producto</h3>
                $htmlErroresGlobales

            <p class="error">{$erroresCampos['idempresa']}</p>
            <select id="idempresa" name="idempresa" value="$idempresa" >
                $empresas
            </select>

            <p class="error">{$erroresCampos['tipo']}</p>
            <select id="tipo" name="tipo" value="$tipo" >
                $tipos
            </select>

            <p class="error">{$erroresCampos['nombre']}</p>
            <input id="nombre" type="text" name="nombre" value="$nombre" placeholder="nombre del producto"/>

            <p class="error">{$erroresCampos['descipcion']}</p>
            <textarea id="descipcion" type="text" name="descipcion" value="$descipcion" placeholder="descripcion"></textarea>

            <p class="error">{$erroresCampos['precio']}</p>
            <input id="precio" type="text" name="precio" value="$precio" placeholder="precio"/>

            <p class="error">{$erroresCampos['link']}</p>
            <input id="link" type="text" name="link" value="$link" placeholder="link"/>

            <p><button type="submit" name="enviar">Confirmar</button><p>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        // Errores posibles
        $this->errores = [];

        $idempresa = trim($datos['idempresa'] ?? '');
        $idempresa = filter_var($idempresa, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($idempresa != '1' && $idempresa != '2' && $idempresa != '3')
            $this->errores['idempresa'] = 'No hagas cosas feas.';
        if (!$idempresa || empty($idempresa))
            $this->errores['idempresa'] = 'Elige un campo.';

        $nombre = trim($datos['nombre'] ?? '');
        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$nombre || empty($nombre)) 
            $this->errores['nombre'] = 'El descripcion de usuario no puede estar vacio.';

        $descripcion = trim($datos['descripcion'] ?? '');
        $descripcion = filter_var($descripcion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$descripcion || empty($descripcion)) 
            $this->errores['descripcion'] = 'El descripcion no puede estar vacío.';
        
        $precio = trim($datos['precio'] ?? '');
        $precio = filter_var($precio, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$precio || empty($precio)) 
            $this->errores['precio'] = 'Los precio no pueden estar vacios.';

        $link = trim($datos['link'] ?? '');
        $link = filter_var($link, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$link || empty($link)) 
            $this->errores['link'] = 'El link no puede estar vacio.';

        $tipo = trim($datos['tipo'] ?? '');
        $tipo = filter_var($tipo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$tipo || empty($tipo) || mb_strlen($tipo) < 5) 
            $this->errores['tipo'] = 'El tipo tiene que tener una longitud de al menos 5 caracteres.';

        // Si todo ha ido bien, 
        if (count($this->errores) === 0) {
            try {
                switch ($idempresa) {
                    case 1:
                        break;
                    case 2:
                        break;
                    case 3:
                        break;
                    default: break;
                }
            }
            catch (\Exception $e) {
                $this->errores[] = 'Imposible crear al usuario';
            }
        }
    }
}