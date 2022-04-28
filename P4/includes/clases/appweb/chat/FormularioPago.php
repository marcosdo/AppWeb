<?php
namespace appweb\chat;

use appweb\Aplicacion;
use appweb\Formulario;
use appweb\usuarios\Profesional;
use appweb\usuarios\Premium;

class FormularioPago extends Formulario {
    public function __construct() {
        parent::__construct('formPago', ['urlRedireccion' => 'chatusu.php']);
    }
    
    protected function generaCamposFormulario(&$datos) {
        // Se reutiliza el nombre de usuario introducido previamente o se deja en blanco
        $id = $datos['peso'] ?? '';
        $id = $datos['altura'] ?? '';
        $id = $datos['alergias'] ?? '';
        $id = $datos['observaciones'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['peso', 'altura', 'alergias', 'observaciones'], $this->errores, 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        <p class="error">{$erroresCampos['peso']}</p>
        <input type="text" name="peso" placeholder="peso"/>
        <p class="error">{$erroresCampos['altura']}</p>
        <input type="text" name="altura" placeholder="altura"/>
        <p class="error">{$erroresCampos['alergias']}</p>
        <input type="text" name="alergias" placeholder="alergias"/>
        <p class="error">{$erroresCampos['observaciones']}</p>
        <input type="text" name="observaciones" placeholder="observaciones adicionales"/>
        <button type="submit" name="pagar">Pagar</button>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        $this->errores = [];
        $peso = trim($datos['peso'] ?? '');
        $altura = trim($datos['altura'] ?? '');
        $alergias = trim($datos['alergias'] ?? '');
        $observaciones = trim($datos['observaciones'] ?? '');

        $peso = filter_var($peso, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$peso || empty($peso)) $this->errores['peso'] = 'El peso debe rellenarse';

        $altura = filter_var($altura, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$altura || empty($altura)) $this->errores['altura'] = 'La altura debe rellenarse';
        
        $alergias = filter_var($alergias, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$alergias && $alergias != "") $this->errores['alergias'] = 'Introduzca un valor valido en alergias';

        $observaciones = filter_var($observaciones, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$observaciones && $observaciones != "") $this->errores['observaciones'] = 'Introduzca un valor valido en observaciones adicionales';

        if (count($this->errores) === 0) {
            try {
                $app = Aplicacion::getInstance();
                $idUsuario = $app->idUsuario();
                $nombre = $app->nombreUsuario();

                $nutri = Profesional::buscaPorMenosUsuarios();
                $premium = Premium::creaPremium($peso, $altura, $alergias, $observaciones, 0, "", $idUsuario, $nutri->getId());
                $nuevoCliente = Profesional::nuevoCliente($nombre, $nutri->getNum_usuarios() + 1, $nutri->getId(), $nutri->getNick());

                Premium::setPremium($idUsuario);
                $app->setPremium(1);

            }
            catch (\Exception $e) {
                if (!$nutri)
                    $this->errores[] = "Ha ocurrido un problema al asignarle nutricionista";
                else if (!$premium)
                    $this->errores[] = "No se ha añadido al usuario a premium";
                else if (!$nuevoCliente)
                    $this->errores[] = "No se ha añadido al usuario al profesional";
                else $this->errores[] = "No se ha actualizado a premium al usuario";
            }
        }    
    }
}