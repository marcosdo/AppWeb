<?php

namespace appweb\foro;

use appweb\Aplicacion;
use appweb\Formulario;
use appweb\foro\Mensaje;
use Exception;

class FormularioEditaMensaje extends Formulario {
    private $idMensaje;
    private $idMensajeRetorno;

    public function __construct($idMensaje = -1, $idMensajeRetorno = NULL) {
        parent::__construct('formEditaMensaje', ['formId' => $idMensaje]);
        $this->idMensaje = $idMensaje;
        $this->idMensajeRetorno = $idMensajeRetorno;
    }

    protected function generaCamposFormulario(&$datos) {
        $mensajePadre = '';
        if ($this->idMensajeRetorno) {
            $mensajePadre = <<<EOS
                <input type="hidden" name="idMensajeRetorno" value="{$this->idMensajeRetorno}" />
            EOS;
        }

        $idMensaje = $datos['idMensaje'] ?? $this->idMensaje;
        $textoMensaje = $datos['mensaje'] ?? '';
        if (empty($textoMensaje) && $idMensaje != null) {
            $mensaje = Mensaje::buscaxID($idMensaje);
            if ($mensaje != null) {
                $textoMensaje =  $mensaje->getMensaje();
            }
        }

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['mensaje'], $this->errores, 'span', array('class' => 'error'));

        $camposFormulario = <<<EOF
        <input type="hidden" name="idMensaje" value="{$this->idMensaje}" />
        $mensajePadre
        <fieldset>
            $htmlErroresGlobales
            <div>
                <label for="mensaje">Mensaje: </label>
                <input id="mensaje" type="text" name="mensaje" value="{$textoMensaje}"/>
                {$erroresCampos['mensaje']}
            </div>
            <div>
                <button type="submit">Actualiza</button>
            </div>
        </fieldset>
        EOF;
        return $camposFormulario;
    }

    /**
     * Procesa los datos del formulario.
     */
    protected function procesaFormulario(&$datos) {
        $this->errores = [];

        $mensaje = trim($datos['mensaje'] ?? '');
        $mensaje = filter_var($mensaje, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$mensaje ||  mb_strlen($mensaje) == 0 || mb_strlen($mensaje) > Mensaje::MAX_SIZE) {
            $this->errores['mensaje'] = 'La longitud del mensaje debe ser entre 1 o 140 caracteres.';
            $ok = false;
        }

        $idMensaje = $datos['idMensaje'] ?? null;
        if (!$idMensaje) {
            $this->errores[] = 'No tengo claro que mensaje actualizar.';
        }

        $idMensajeRetorno = \filter_var($datos['idMensajeRetorno'] ?? null, FILTER_SANITIZE_NUMBER_INT);

        if (count($this->errores) === 0) {
            try {
                $app = Aplicacion::getInstance();
                $msg = Mensaje::buscaxID($idMensaje);
                if ($app->usuarioLogueado() && ($app->idUsuario() == $msg->getIDUsuario())) {
                    $msg->setMensaje($mensaje);
                    $msg->actualizaBD();
                }
            } catch (Exception $e) {
                $this->errores[] = 'Imposible actualizar el mensaje';
            }
        
            if ($idMensajeRetorno) {
                $this->urlRedireccion = $app->buildUrl('/mensajes.php', ['id' => $idMensajeRetorno]);
            } else {
                $this->urlRedireccion = $app->buildUrl('/foros.php');
            }
        }
    }
}