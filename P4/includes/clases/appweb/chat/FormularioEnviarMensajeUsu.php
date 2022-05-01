<?php
namespace appweb\chat;

use appweb\Formulario;



class FormularioEnviarMensajeUsu extends Formulario {
    public function __construct() {
        parent::__construct('formChatUsuario', ['urlRedireccion' => 'chatusu.php']);
    }
    
    protected function generaCamposFormulario(&$datos) {
        $mensaje =  $datos['mensaje'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['mensaje'], $this->errores, 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        <h3>Enviar Mensaje</h3>
        $htmlErroresGlobales
        <p class="error">{$erroresCampos['mensaje']}</p>
        <input id="mensaje" type="text" name="mensaje" value="$mensaje" placeholder="mensaje" />
        <button type="submit" name="enviar">Confirmar</button>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        // Errores posibles
        $this->errores = [];

        $msg = trim($datos['mensaje'] ?? '');
        $msg = filter_var($msg, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$msg || empty($msg)) 
            $this->errores['mensaje'] = 'El mensaje no puede estar vacio.';
            
        // Si todo ha ido bien, 
        if (count($this->errores) === 0) {
            try {
                Chat::enviarMsgUsu($msg);
            }
            catch (\Exception $e) {
                $this->errores[] = 'Imposible crear el mensaje';
            }
        }
    }
}