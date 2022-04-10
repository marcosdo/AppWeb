<?php
namespace es\ucm\fdi\aw;

class FormularioRegistro extends Formulario {

    public function __construct() {
        parent::__construct('formRegistro', ['urlRedireccion' => 'logout.php']);
    }
    
    protected function generaCamposFormulario(&$datos) {
        $alias = $datos['alias'] ?? '';
        $nombre = $datos['nombre'] ?? '';
        $apellidos = $datos['apellidos'] ?? '';
        $mail = $datos['mail'] ?? '';


        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombre', 'apellidos', 'mail', 'alias', 'password', 'password2'], $this->errores, 'span', array('class' => 'error'));
        $html = <<<EOF
        $htmlErroresGlobales
        <p class="error">{$erroresCampos['nombre']}</p>
        <input id="nombre" type="text" name="nombre" value="$nombre" placeholder="nombre" />
        <p class="error">{$erroresCampos['apellidos']}</p>
        <input id="apellidos" type="text" name="apellidos" value="$apellidos" placeholder="apellidos" />
        <p class="error">{$erroresCampos['alias']}</p>
        <input id="alias" type="text" name="alias" value="$alias" placeholder="usuario" />
        <p class="error">{$erroresCampos['mail']}</p>
        <input id="mail" type="text" name="mail" value="$mail" placeholder="correo electronico" />
        <p class="error">{$erroresCampos['password']}
        <input id="password" type="password" name="password" placeholder="password" />
        <p class="error">{$erroresCampos['password2']}</p>
        <input id="password2" type="password" name="password2" placeholder="reintroduce la password" />
        <button type="submit" name="registro">Registrar</button>
        <p class="message">¿Ya estas registrado? <a href='#'>Logeate.</a></p>
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
                Usuario::register($alias, $nombre, $apellidos, $mail, $password);
                // Mensaje POP UP ejercicio 3 anexo 1
                $app = Aplicacion::getInstance();
                $mensajes = ['Se ha registrado exitosamente', "Gracias $nombre, para empezar a usar lifety inicie sesión"];
                $app->putAtributoPeticion('mensajes', $mensajes);
            } catch (UsuarioYaExisteException $e) {
                $this->errores[] = 'El nombre de usuario no puede estar repetido.';
            }
        }
    }
}