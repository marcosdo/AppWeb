<?php
namespace appweb;

use Exception;

class FormularioAdminBorra extends Formulario {
    public function __construct() {
        parent::__construct('formAdminBorra', ['urlRedireccion' => 'admin.php']);
    }
    
    protected function generaCamposFormulario(&$datos) {
        $rol = $datos['rol'] ?? '';
        $nick1 = $datos['nick1'] ?? '';
        $nick2 = $datos['nick2'] ?? '';
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['rol', 'nick1', 'nick2'], $this->errores, 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        <h3>Elimina un usuario</h3>
        <p>Para eliminar un usuario introduce su nick</p>
        $htmlErroresGlobales
        <p class="error">{$erroresCampos['rol']}</p>
        <select id="rol" name="rol" value="$rol" >
            <option disabled="disabled" selected="selected">Tipo de rol</option>
            <option value="1">Admin</option>
            <option value="2">Usuario</option>
            <option value="3">Profesional</option>
        </select>
        <p class="error">{$erroresCampos['nick1']}</p>
        <input id="nick1" type="text" name="nick1" value="$nick1" placeholder="usuario" />
        <p class="error">{$erroresCampos['nick2']}</p>
        <input id="nick2" type="text" name="nick2" value="$nick2" placeholder="usuario" />
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
            $this->errores['rol'] = 'Obligatorio elegir un campo.';

        $nick1 = trim($datos['nick1'] ?? '');
        $nick1 = filter_var($nick1, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$nick1 || empty($nick1)) 
            $this->errores['nick1'] = 'Campo obligatorio.';

        $nick2 = trim($datos['nick2'] ?? '');
        $nick2 = filter_var($nick2, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$nick1 || empty($nick2) || $nick1 !== $nick2)
            $this->errores['nick2'] = 'Los campos deben coincidir';

        // Si todo ha ido bien, 
        if (count($this->errores) === 0) {
            try {
                $this->errores[] = 'Metodos de borrado no implementados';
                switch ($rol) {
                    case 1:
                        //Personas::borraxNick($nick1);
                        break;
                    case 2:
                        //Usuario::borraxNick($nick1);
                        break;
                    case 3:
                        //Profesional::borraxNick($nick1);
                        break;
                    default: break;
                }
            }
            catch (Exception $e) {
                $this->errores[] = 'Imposible borrar usuario';
            }
        }
    }
}