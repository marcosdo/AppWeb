<?php
namespace appweb\admin;

use appweb\Formulario;
use appweb\Aplicacion;
use appweb\productos\Empresas;

class FormAdminCreaEmpresa extends Formulario {
    public function __construct() {
        parent::__construct('formAdminCreaEmp', ['urlRedireccion' => 'index.php']);
    }

    protected function generaCamposFormulario(&$datos) {
        $nombre = $datos['nombre'] ?? '';
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['idempresa', 'nombre'], $this->errores, 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
            <h3>Inserta una empresa</h3>
                $htmlErroresGlobales

            <p class="error">{$erroresCampos['nombre']}</p>
            <input id="nombre" type="text" name="nombre" value="$nombre" placeholder="nombre de la empresa"/>

            <p><button type="submit" name="enviar">Confirmar</button></p>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        // Errores posibles
        $this->errores = [];

        $nombre = trim($datos['nombre'] ?? '');
        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$nombre || empty($nombre)) 
            $this->errores['nombre'] = 'El nombre de la empresa no puede estar vacio.';

        // Si todo ha ido bien, 
        if (count($this->errores) === 0) {
            try {
                Empresas::CreaEmpresas($nombre);

                $app = Aplicacion::getInstance();
                $mensajes = ['Operacion realizada con exito', "{$nombre} se ha incluido en la BD"];
                $app->putAtributoPeticion('mensajes', $mensajes);
            }
            catch (\Exception $e) {
                $this->errores[] = 'Imposible crear la empresa';
            }
        }
    }
}