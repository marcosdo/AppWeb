<?php
namespace appweb\usuarios;

use appweb\Formulario;
use appweb\Aplicacion;

class FormularioEditaUsuario extends Formulario {
    private $_user = null;

    public function __construct($user) {
        $this->_user = $user; 
        parent::__construct('formEditaUsuario', ['urlRedireccion' => 'micuenta.php']);
    }
    
    protected function generaCamposFormulario(&$datos) {

        $actual_nombre = $this->_user->getNombre();
        $actual_apellido = $this->_user->getApellidos();
        $actual_correo = $this->_user->getCorreo();


        $alias = $datos['alias'] ?? '';
        $nombre = $datos['nombre'] ?? '';
        $apellidos = $datos['apellidos'] ?? '';
        $mail = $datos['mail'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombre', 'apellidos', 'mail', 'alias', 'password', 'password2'], $this->errores, 'span', array('class' => 'error'));
        
        // HTML con los campos del formulario
        $html = <<<EOF
            $htmlErroresGlobales
            <p class="error">{$erroresCampos['nombre']}</p>
            <input id="nombre" type="text" name="nombre" value="$nombre" placeholder="" />
            
            <p class="error">{$erroresCampos['apellidos']}</p>
            <input id="apellidos" type="text" name="apellidos" value="$apellidos" placeholder="" />
            
            <p class="error">{$erroresCampos['alias']}</p>
            <input id="alias" type="text" name="alias" value="$alias" placeholder="" />
            
            <p class="error">{$erroresCampos['mail']}</p>
            <input id="mail" type="text" name="mail" value="$mail" placeholder="" />
            
            <p class="error">{$erroresCampos['password']}
            <input id="password" type="password" name="password" placeholder="" />
            
            <p class="error">{$erroresCampos['password2']}</p>
            <input id="password2" type="password" name="password2" placeholder="" />
            
            <button type="submit" name="registro">Registrar</button>
            <p class="message">¿Ya estas registrado? <a href='#'>Logeate.</a></p>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        $this->errores = [];
        
        $a = trim($datos[''] ?? '');
        $a = filter_var($a, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$a || empty($a))
            $this->errores[''] = '';
        
        if (count($this->errores) === 0) {
            try {
                $app = Aplicacion::getInstance();
                $mensajes = ['Se han actualizado exitosamente', "Bienvenido {$app->nombreUsuario()}"];
                $app->putAtributoPeticion('mensajes', $mensajes);
            }
            catch (\Exception $e) {
                $this->errores[] = "";
            }
        }
    }
}