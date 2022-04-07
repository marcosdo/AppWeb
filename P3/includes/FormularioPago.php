<?php
namespace es\ucm\fdi\aw;

use Exception;

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
        <fieldset>
            <legend> Por favor, introduzca sus datos:</legend>
            <div>
                <label for="peso">Introduzca su peso:</label>
                <input type="text" name="peso"/>
                {$erroresCampos['peso']}
            </div>
            <div>
                <label for="altura">Introduzca su altura:</label>
                <input type="text" name="altura" />
                {$erroresCampos['altura']}
            </div>
            <div>
                <label for="alergias">Si tiene alguna alergia rellene este campo:</label>
                <input type="text" name="alergias"/>
                {$erroresCampos['alergias']}
            </div>
            <div>
                <label for="observaciones">Alguna observacion adicional:</label>
                <input type="text" name="observaciones"/>
                {$erroresCampos['observaciones']}
            </div>
            <div>
                <button type="submit" name="pagar" value="pagar">Pagar</button>
            </div>
        </fieldset>
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
            $nutri = Nutri::buscaPorMenosUsuarios();
            if (!$nutri) $this->errores[] = "Ha ocurrido un problema al asignarle nutricionista";
            else {
                if(!Premium::crea($peso, $altura, $alergias, $observaciones, 0, "", $_SESSION['id'], $nutri->getId()))  $this->errores[] = "No se ha añadido al usuario a premium";
                else {
                    if(!Nutri::nuevoCliente($_SESSION['alias'], $nutri->getNum_usuarios() + 1, $nutri->getId(),$nutri->getAlias())) $this->errores[] = "No se ha añadido al usuario al profesional";
                    else {
                        try {
                            Usuario::setPremium($_SESSION['id']);
                            $usuario = Usuario::buscaPorId($_SESSION['id']);
                            $_SESSION['premium'] = $usuario->getPremium();
                        } catch (Exception $e) {
                            $this->errores[] = "No se ha actualizado a premium al usuario";
                        }
                    }
                }
            }
        }    
    }
}