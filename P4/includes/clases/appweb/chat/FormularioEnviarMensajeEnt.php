<?php
namespace appweb\chat;

use appweb\Aplicacion;
use appweb\Formulario;
use appweb\usuarios\Profesional;


class FormularioEnviarMensajeEnt extends Formulario {
    public function __construct() {
        parent::__construct('formChatEntrenador', ['urlRedireccion' => 'chatprof.php']);
    }
   
    public static function Usuarios($entNombre){
        $rts = "";
        $array = Profesional::getUsuario($entNombre);
        for ($i=0; $i < sizeof($array); $i++) { 
            $rts = $rts ."<option value='$array[$i]'>$array[$i]</option>";
        } 
        return $rts;
    }
    protected function generaCamposFormulario(&$datos) {
        $mensaje =  $datos['mensaje'] ?? '';
        $usuario = $datos['usuario'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['mensaje','usuario'], $this->errores, 'span', array('class' => 'error'));
        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $app = Aplicacion::getInstance();
        $selectUsuarios = self::Usuarios($app->nombreUsuario());
        $html = <<<EOF
        $htmlErroresGlobales
        <p class="error">{$erroresCampos['usuario']}</p>
        <select name = "usuario" value="$usuario">
        $selectUsuarios
        </select>
        <p class="error">{$erroresCampos['mensaje']}</p>
        <input id="mensaje" type="text" name="mensaje" value="$mensaje" placeholder="Introduzca el mensaje a enviar..." />
        <button type="submit" name="enviar">Confirmar</button>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        // Errores posibles
        $this->errores = [];
        $usuario = trim($datos['usuario'] ?? '');
        $usuario = filter_var($usuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$usuario || empty($usuario)) 
            $this->errores['usuario'] = 'El usuario no puede estar vacio.';

        $msg = trim($datos['mensaje'] ?? '');
        $msg = filter_var($msg, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$msg || empty($msg)) 
            $this->errores['mensaje'] = '';
            
        // Si todo ha ido bien, 
        if (count($this->errores) === 0) {
            try {
               Chat::enviarMsgEnt($usuario,$msg);
            }
            catch (\Exception $e) {
                $this->errores[] = 'Imposible crear el mensaje';
            }
        }
    }
}