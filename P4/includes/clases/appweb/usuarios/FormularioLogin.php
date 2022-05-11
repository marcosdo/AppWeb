<?php
namespace appweb\usuarios;

use appweb\Formulario;
use appweb\Aplicacion;

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
        <input id="passwordL" type="password" name="password" placeholder="password"/>
        <button type="submit" name="login">Entrar</button>
        <h4 class="message">¿No estas registrado? <a href='#'>Crea una cuenta</a></h4>
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
                $app = Aplicacion::getInstance();
                $usuario = Personas::login($alias, $password);
                $app->login($usuario);
                $aux = Usuario::buscaID($app->idUsuario());
                if ($aux)
                    $app->setPremium($aux->getPremium());
                else $app->setPremium(0);  
                $app = Aplicacion::getInstance();
                $mensajes = ['Se ha logeado exitosamente', "Bienvenido {$app->nombreUsuario()}"];
                $app->putAtributoPeticion('mensajes', $mensajes);
            }
            catch (\Exception $e) {
                $this->errores[] = "El usuario o el password no coinciden";
            }
        }
    }
}