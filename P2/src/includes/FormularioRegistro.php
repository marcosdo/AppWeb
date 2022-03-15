<?php
namespace es\ucm\fdi\aw;

class FormularioRegistro extends Formulario {

    public function __construct() {
        parent::__construct('formRegistro', ['urlRedireccion' => 'index.php']);
    }
    
    protected function generaCamposFormulario(&$datos) {
        $nombre = $datos['nombre'] ?? '';
        $apellidos = $datos['apellidos'] ?? '';
        $mail = $datos['mail'] ?? '';


        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombreUsuario', 'nombre', 'password', 'password2'], $this->errores, 'span', array('class' => 'error'));

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
                <label for="mail">>Direccion de correo:</label>
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
    

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$nombre || empty($nombre=trim($nombre))) {
            $this->errores['nombre'] = 'El nombre no puede estar vacío.';
        }

        $apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$apellidos || empty($apellidos=trim($apellidos))) {
            $this->errores['apellidos'] = 'Los apellidos no pueden estar vacios.';
        }

        $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $mail || empty($mail=trim($mail))) {
            $this->errores['mail'] = 'El mail no puede estar vacio.';
        }

        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password || empty($password=trim($password)) || mb_strlen($password) < 5 ) {
            $this->errores['password'] = 'El password tiene que tener una longitud de al menos 5 caracteres.';
        }

        $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password2 || empty($password2=trim($password2)) || $password != $password2 ) {
            $this->errores['password2'] = 'Los passwords deben coincidir';
        }

        if (count($this->errores) === 0) {
            $usuario = Usuario::crea($apellidos, $mail, $nombre, $password, 0);
            
            if (! $usuario ) {
                $this->errores[] = "El usuario ya existe";
            } else {
                $_SESSION['login'] = true;
                $_SESSION['nombre'] = $usuario->getNombre();
                $_SESSION['id'] = $usuario->getId();
                header('Location: index.php');
                exit();
            }
        }
    }
}