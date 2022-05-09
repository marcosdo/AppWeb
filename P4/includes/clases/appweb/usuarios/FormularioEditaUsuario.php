<?php
namespace appweb\usuarios;

use appweb\Formulario;
use appweb\Aplicacion;

class FormularioEditaUsuario extends Formulario {

    public function __construct() {
        parent::__construct('formEditaUsuario', ['urlRedireccion' => 'micuenta.php']);
    }
    
    protected function generaCamposFormulario(&$datos) {
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
            <input id="nombre" type="text" name="nombre" value="$nombre" placeholder="Escribe tu nuevo nombre" />
            
            <p class="error">{$erroresCampos['apellidos']}</p>
            <input id="apellidos" type="text" name="apellidos" value="$apellidos" placeholder="Cambia tus apellidos" />
            
            <div>
                <p class="error">{$erroresCampos['alias']}</p>
                <input id="aliasE" type="text" name="alias" value="$alias" placeholder="Modifica tu nick de usuario" />
                <i class="fa-solid fa-triangle-exclamation" id='aliasNO'></i>
            </div>
            
            <div>
                <p class="error">{$erroresCampos['mail']}</p>
                <input id="mailE" type="email" name="mail" value="$mail" placeholder="Utiliza otra cuenta diferente de mail" />
                <i class="fa-solid fa-triangle-exclamation" id='correoNO'></i>
            </div>
            
            <p class="error">{$erroresCampos['password']}
            <input id="password" type="password" name="password" placeholder="Mejora tu password y actualizala" />
            
            <p class="error">{$erroresCampos['password2']}</p>
            <input id="password2" type="password" name="password2" placeholder="Confirma tu password" />
            
            <button type="submit" name="registro">Actualizar</button>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        $this->errores = [];
       
        $alias = $datos['alias'] ?? '';
        $nombre = $datos['nombre'] ?? '';
        $apellidos = $datos['apellidos'] ?? '';
        $mail = $datos['mail'] ?? '';

        if (!empty($alias)){
            $alias = filter_var($alias, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$alias) $this->errores['alias'] = 'Debe ser un alias valido';
        }

        if (!empty($nombre)){
            $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$nombre) $this->errores['nombre'] = 'Debe ser un nombre valido';
        }

        if (!empty($apellidos)){
            $apellidos = filter_var($apellidos, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$apellidos) $this->errores['apellidos'] = 'Deben ser unos apellidos validos';
        }

        if (!empty($mail)){
            $mail = filter_var($mail, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$mail) $this->errores['mail'] = 'Debe ser un correo valido';
        }
        
        $password = trim($datos['password'] ?? '');
        if(!empty($password)){
            $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$password || mb_strlen($password) < 5) 
                $this->errores['password'] = 'El password tiene que tener una longitud de al menos 5 caracteres.';
                $password2 = trim($datos['password2'] ?? '');
                $password2 = filter_var($password2, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if (!$password2 || empty($password2) || $password != $password2)
                    $this->errores['password2'] = 'Los passwords deben coincidir.';
        }
        
        if (count($this->errores) === 0) {
            try {
                $persona = Personas::buscaPorId($_SESSION['id']);
                if($alias) $persona->updateAlias($alias);
                if($nombre) $persona->updateNombre($nombre);
                if($apellidos) $persona->updateApellidos($apellidos);
                if($mail) $persona->updateMail($mail);
                if($password) $persona->updatePassword($password);
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