<?php
namespace appweb\usuarios;

use appweb\Formulario;
use appweb\Aplicacion;

class FormularioRegistro extends Formulario {

    public function __construct() {
        parent::__construct('formRegistro', ['urlRedireccion' => 'index.php']);
    }
    
    protected function generaCamposFormulario(&$datos) {
        $alias = $datos['alias'] ?? '';
        $nombre = $datos['nombre'] ?? '';
        $apellidos = $datos['apellidos'] ?? '';
        $mail = $datos['mail'] ?? '';

        $rutaimg = RUTA_IMGS;
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombre', 'apellidos', 'mail', 'alias', 'password', 'password2'], $this->errores, 'span', array('class' => 'error'));
        $html = <<<EOF
        $htmlErroresGlobales
        <p class="error">{$erroresCampos['nombre']}</p>
        <input id="nombre" type="text" name="nombre" value="$nombre" placeholder="nombre" />
        <p class="error">{$erroresCampos['apellidos']}</p>
        <input id="apellidos" type="text" name="apellidos" value="$apellidos" placeholder="apellidos" />
        <div>
            <p class="error">{$erroresCampos['alias']}</p>
            <input id="alias" type="text" name="alias" value="$alias" placeholder="usuario" />
            <img id="aliasOK" src='$rutaimg/bien.png' alt=bien>
            <img id="aliasNO" src='$rutaimg/mal.png' alt=mal>
        </div>
        <div>
            <p class="error">{$erroresCampos['mail']}</p>
            <input id="mail" type="email" name="mail" value="$mail" placeholder="correo electronico" />
            <img id="correoOK" src='$rutaimg/bien.png' alt=bien>
            <img id="correoNO" src='$rutaimg/mal.png' alt=mal>
        </div>
        <p class="error">{$erroresCampos['password']}
        <input id="password" type="password" name="password" placeholder="password" />
        <p class="error">{$erroresCampos['password2']}</p>
        <input id="password2" type="password" name="password2" placeholder="reintroduce la password" />
        <button type="submit" name="registro">Registrar</button>
        <h4 class="message">¿Ya estas registrado? <a href='#'>Logeate.</a></h4>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario(&$datos) {
        $this->errores = [];
        
        $nombre = trim($datos['nombre'] ?? '');
        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$nombre || empty($nombre)) 
            $this->errores['nombre'] = 'El nombre no puede estar vacío.';
        
        $apellidos = trim($datos['apellidos'] ?? '');
        $apellidos = filter_var($apellidos, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$apellidos || empty($apellidos)) 
            $this->errores['apellidos'] = 'Los apellidos no pueden estar vacios.';
        
        $alias = trim($datos['alias'] ?? '');
        $alias = filter_var($alias, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$alias || empty($alias)) 
            $this->errores['alias'] = 'El nombre de usuario no puede estar vacio.';

        $mail = trim($datos['mail'] ?? '');
        $mail = filter_var($mail, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$mail || empty($mail)) 
            $this->errores['mail'] = 'El mail no puede estar vacio.';

        $password = trim($datos['password'] ?? '');
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$password || empty($password) || mb_strlen($password) < 5) 
            $this->errores['password'] = 'El password tiene que tener una longitud de al menos 5 caracteres.';

        $password2 = trim($datos['password2'] ?? '');
        $password2 = filter_var($password2, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$password2 || empty($password2) || $password != $password2)
            $this->errores['password2'] = 'Los passwords deben coincidir.';

        if (count($this->errores) === 0) {
            try {
                $usuario = Usuario::registra($alias, $nombre, $apellidos, $mail, $password);
                $usuario = Usuario::buscaPorAlias($alias);
                $app = Aplicacion::getInstance();
                $app->login($usuario);
                /* POP UP */
                $mensajes = ['Se ha registrado exitosamente', "Gracias $nombre"];
                $app->putAtributoPeticion('mensajes', $mensajes);
            } catch (UsuarioYaExisteException $e) {
                $this->errores[] = 'El nombre de usuario no puede estar repetido.';
            }
        }
    }
}