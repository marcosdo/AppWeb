<?php
namespace appweb;

use Exception;

class FormularioAdminCrea extends Formulario {
    public function __construct() {
        parent::__construct('formAdminCrea', ['urlRedireccion' => 'admin.php']);
    }
    
    protected function generaCamposFormulario(&$datos) {
        $rol = $datos['rol'] ?? '';
        $alias = $datos['alias'] ?? '';
        $nombre = $datos['nombre'] ?? '';
        $apellidos = $datos['apellidos'] ?? '';
        $mail = $datos['mail'] ?? '';
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['rol', 'alias', 'nombre', 'apellidos', 'mail', 'password', 'password2'], $this->errores, 'span', array('class' => 'error'));


        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        <h3>Crea un usuario</h3>
        $htmlErroresGlobales
        <p class="error">{$erroresCampos['rol']}</p>
        <select id="rol" name="rol" value="$rol" >
            <option disabled="disabled" selected="selected">Tipo de rol</option>
            <option value="1">Admin</option>
            <option value="2">Usuario</option>
            <option value="3">Profesional</option>
        </select>
        <p class="error">{$erroresCampos['alias']}</p>
        <input id="alias" type="text" name="alias" value="$alias" placeholder="usuario" />
        <p class="error">{$erroresCampos['nombre']}</p>
        <input id="nombre" type="text" name="nombre" value="$nombre" placeholder="nombre" />
        <p class="error">{$erroresCampos['apellidos']}</p>
        <input id="apellidos" type="text" name="apellidos" value="$apellidos" placeholder="apellidos" />
        <p class="error">{$erroresCampos['mail']}</p>
        <input id="mail" type="text" name="mail" value="$mail" placeholder="correo electronico" />
        <p class="error">{$erroresCampos['password']}
        <input id="password" type="password" name="password" placeholder="password" />
        <p class="error">{$erroresCampos['password2']}</p>
        <input id="password2" type="password" name="password2" placeholder="reintroduce la password" />
        <button type="submit" name="enviar">Confirmar</button>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        // Errores posibles
        $this->errores = [];

        $rol = trim($datos['rol'] ?? '');
        $rol = filter_var($rol, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($rol != '1' && $rol != '2' && $rol != '3')
            $this->errores['rol'] = 'No hagas cosas feas.';
        if (!$rol || empty($rol))
            $this->errores['rol'] = 'Elige un campo.';

        $alias = trim($datos['alias'] ?? '');
        $alias = filter_var($alias, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$alias || empty($alias)) 
            $this->errores['alias'] = 'El nombre de usuario no puede estar vacio.';

        $nombre = trim($datos['nombre'] ?? '');
        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$nombre || empty($nombre)) 
            $this->errores['nombre'] = 'El nombre no puede estar vacío.';
        
        $apellidos = trim($datos['apellidos'] ?? '');
        $apellidos = filter_var($apellidos, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$apellidos || empty($apellidos)) 
            $this->errores['apellidos'] = 'Los apellidos no pueden estar vacios.';

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

        // Si todo ha ido bien, 
        if (count($this->errores) === 0) {
            try {
                switch ($rol) {
                    case 1:
                        Usuario::registra($alias, $nombre, $apellidos, $mail, $password, Personas::ADMIN_ROLE);
                        break;
                    case 2:
                        Usuario::registra($alias, $nombre, $apellidos, $mail, $password);
                        break;
                    case 3:
                        Profesional::registra($alias, $nombre, $apellidos, $mail, $password);
                        break;
                    default: break;
                }
            }
            catch (Exception $e) {
                $this->errores[] = 'Imposible crear al usuario';
            }
        }
    }
}