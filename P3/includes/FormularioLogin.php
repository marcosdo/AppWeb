<?php
namespace appweb;

use Exception;

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
        $html = <<<EOF
        $htmlErroresGlobales
        <p class="error">{$erroresCampos['alias']}</p>
        <input id="alias" type="text" name="alias" value="$alias" placeholder="usuario" />
        <p class="error">{$erroresCampos['password']}</p>
        <input id="password" type="password" name="password" placeholder="password"/>
        <button type="submit" name="login">Entrar</button>
        <p class="message">¿No estas registrado? <a href='#'>Crea una cuenta</a></p>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        $this->errores = [];
        $alias = trim($datos['alias'] ?? '');
        $alias = filter_var($alias, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$alias || empty($alias))
            $this->errores['alias'] = 'El usuario no puede estar vacío';
        
        $password = trim($datos['password'] ?? '');
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$password || empty($password)) 
            $this->errores['password'] = 'El password no puede estar vacío.';
        
        if (count($this->errores) === 0) {
            try {
                $usuario = Personas::login($alias, $password);
                $_SESSION['login'] = true;
                $_SESSION['id'] = $usuario->getId();
                $_SESSION['alias'] = $usuario->getAlias();
                $_SESSION['nombre'] = $usuario->getNombre();
                $_SESSION['rol'] = $usuario->getRol();
                $app = Aplicacion::getInstance();
                $mensajes = ['Se ha logeado exitosamente', "Bienvenido {$_SESSION['alias']}"];
                $app->putAtributoPeticion('mensajes', $mensajes);
            }
            catch (Exception $e) {
                $this->errores[] = "El usuario o el password no coinciden";
            }
        }
    }
}