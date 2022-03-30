<?php
namespace es\ucm\fdi\aw;

class FormularioRegistro extends Formulario {

    public function __construct() {
        parent::__construct('formRegistro', ['urlRedireccion' => 'index.php']);
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
        <fieldset>
            <legend>Datos para el registro</legend>
            <div>
                <label for="nombre">Nombre:</label>
                <input id="nombre" type="text" name="nombre" value="$nombre" />
                {$erroresCampos['nombre']}
            </div>
            <div>
                <label for="apellidos">Apellidos:</label>
                <input id="apellidos" type="text" name="apellidos" value="$apellidos" />
                {$erroresCampos['apellidos']}
            </div>
            <div>
                <label for="alias">Nombre de usuario:</label>
                <input id="alias" type="text" name="alias" value="$alias" />
                {$erroresCampos['alias']}
            </div>
            <div>
                <label for="mail">Direccion de correo:</label>
                <input id="mail" type="text" name="mail" value="$mail" />
                {$erroresCampos['mail']}
            </div>
            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" />
                {$erroresCampos['password']}
            </div>
            <div>
                <label for="password2">Reintroduce el password:</label>
                <input id="password2" type="password" name="password2" />
                {$erroresCampos['password2']}
            </div>
            <div>
                <button type="submit" name="registro">Registrar</button>
            </div>
        </fieldset>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario(&$datos) {
        $this->errores = [];
        
        $nombre = trim($datos['nombre'] ?? '');
        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$nombre || empty($nombre)) $this->errores['nombre'] = 'El nombre no puede estar vacío.';
        
        $apellidos = trim($datos['apellidos'] ?? '');
        $apellidos = filter_var($apellidos, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$apellidos || empty($apellidos)) $this->errores['apellidos'] = 'Los apellidos no pueden estar vacios.';
        
        $alias = trim($datos['alias'] ?? '');
        $alias = filter_var($alias, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$alias || empty($alias)) {
            if(Usuario::buscaPorAlias($alias) || Nutri::buscaPorAlias($alias)) $this->errores['alias'] = 'El nombre de usuario no puede estar repetido.';
            else $this->errores['alias'] = 'El nombre de usuario no puede estar vacio.';
        }

        $mail = trim($datos['mail'] ?? '');
        $mail = filter_var($mail, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$mail || empty($mail)) $this->errores['mail'] = 'El mail no puede estar vacio.';

        $password = trim($datos['password'] ?? '');
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$password || empty($password) || mb_strlen($password) < 5) $this->errores['password'] = 'El password tiene que tener una longitud de al menos 5 caracteres.';

        $password2 = trim($datos['password2'] ?? '');
        $password2 = filter_var($password2, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$password2 || empty($password2) || $password != $password2) $this->errores['password2'] = 'Los passwords deben coincidir.';

        if (count($this->errores) === 0) {
            $usuario = Usuario::buscaPorAlias($Alias);
            if ($usuario) $this->errores[] = "El usuario ya existe";
            else {
                $usuario = Usuario::crea($nombre, $apellidos, $mail, $password, $alias, 0);
                $_SESSION['login'] = true;
                $_SESSION['nombre'] = $usuario->getNombre();
                $_SESSION['id'] = $usuario->getId();
                $_SESSION['alias'] = $usuario->getAlias();
                $_SESSION['premium'] = $usuario->getPremium();
            }
        }
    }
}