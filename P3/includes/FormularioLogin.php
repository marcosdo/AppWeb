<?php
namespace es\ucm\fdi\aw;

class FormularioLogin extends Formulario {
    public function __construct() {
        parent::__construct('formLogin', ['urlRedireccion' => 'index.php']);
    }
    
    protected function generaCamposFormulario(&$datos) {
        // Se reutiliza el nombre de usuario introducido previamente o se deja en blanco
        $alias = $datos['alias'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['alias', 'password'], $this->errores, 'span', array('class' => 'error'));
        
        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $img = RUTA_IMGS;
        $ruta = RUTA_APP;
        $html = <<<EOF
        $htmlErroresGlobales
        <div class=form>
            <div class="thumbnail">
                <img src='$img/login.jpg' alt=thumbnail/>
            </div>
            <p class="error">{$erroresCampos['alias']}</p>
            <input id="alias" type="text" name="alias" value="$alias" placeholder="usuario" />
            <p class="error">{$erroresCampos['password']}</p>
            <input id="password" type="password" name="password" placeholder="password"/>
            <button type="submit" name="login">Entrar</button>
            <p class="message">¿No estas registrado? <a href='$ruta/registro.php'>Crea una cuenta</a></p>
        </div>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        $this->errores = [];
        $alias = trim($datos['alias'] ?? '');
        $alias = filter_var($alias, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$alias || empty($alias)) $this->errores['alias'] = 'El usuario no puede estar vacío';
        
        $password = trim($datos['password'] ?? '');
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!$password || empty($password)) $this->errores['password'] = 'El password no puede estar vacío.';
        
        if (count($this->errores) === 0) {
            $usuario = Usuario::login($alias, $password);
            $nutri = Nutri::login($alias, $password);
            if (!$usuario && !$nutri) $this->errores[] = "El usuario o el password no coinciden";
            else if($usuario) {
                $_SESSION['login'] = true;
                $_SESSION['nombre'] = $usuario->getNombre();
                $_SESSION['alias'] = $usuario->getAlias();
                $_SESSION['id'] = $usuario->getId();
                $_SESSION['premium'] = $usuario->getPremium();
            }
            else if($nutri) {
                $_SESSION['login'] = true;
                $_SESSION['nombre'] = $nutri->getNombre();
                $_SESSION['alias'] = $nutri->getAlias();
                $_SESSION['id'] = $nutri->getId();
                $_SESSION['nutri'] = true;
            }
        }
    }
}