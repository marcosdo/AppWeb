<?php
namespace appweb\foro;

use appweb\Formulario;
use appweb\Aplicacion;
use appweb\foro\Mensaje;

class FormularioMensaje extends Formulario {
    public function __construct() { 
        parent::__construct('formForo', ['urlRedireccion' => 'foroaux.php']);
    }

    protected function generaCamposFormulario(&$datos) {
        $titulo = $datos['titulo'] ?? '';
        $mensaje = $datos['mensaje'] ?? '';
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['titulo', 'mensaje'], $this->errores, 'span', array('class' => 'error'));
        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        <input id="titulo" type="text" name="titulo" value="$titulo" placeholder="titulo" />
        <input id="mensaje" type="text" name="mensaje" value="$mensaje" placeholder="mensaje" />
        <button type="submit" name="enviar">Responde a este mensaje</button>
        EOF;
        return $html;
    
    
    }

    protected function procesaFormulario(&$datos) { 
        $this->errores = [];

        $titulo = $datos['titulo'] ?? '';
        $mensaje = $datos['mensaje'] ?? '';

        $titulo = filter_var($titulo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$titulo || empty($titulo))
            $this->errores['titulo'] = '¿Cuál es el titulo del mensaje?';

        $mensaje = filter_var($mensaje, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$mensaje || empty($mensaje))
            $this->errores['mensaje'] = 'Es necesario rellenar el mensaje de contestacion.';

        if (count($this->errores) === 0) {
            try {
                Mensaje::creaMensaje($_SESSION['id'], $_GET['idforo'], $mensaje, null,$titulo);
                /* POP UP */
                $app = Aplicacion::getInstance();
                $mensajes = ['Se ha creado el mensaje'];
                $app->putAtributoPeticion('mensajes', $mensajes);
            } catch (\Exception $e) {
                $this->errores[] = 'Este tema ya existe.';
           }
        }

    }
}