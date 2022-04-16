<?php

namespace appweb\foro;

use appweb\Aplicacion;
use appweb\Formulario;
use appweb\foro\Mensaje;

class FormularioBorraMensaje extends Formulario {
    private $idMensaje;
    private $idMensajeRetorno;

    public function __construct($idMensaje = -1, $idMensajeRetorno = NULL) {
        parent::__construct('formBorraMensaje', ['class' => 'inline', 'formId' => $idMensaje]);
        $this->idMensaje = $idMensaje;
        $this->idMensajeRetorno = $idMensajeRetorno;
    }

    protected function generaCamposFormulario(&$datos) {
        $mensajeRetorno = '';
        if ($this->idMensajeRetorno) {
            $mensajeRetorno = <<<EOS
            <input type="hidden" name="idMensajeRetorno" value="{$this->idMensajeRetorno}" />
            EOS;
        }

        $camposFormulario = <<<EOF
        <input type="hidden" name="idMensaje" value="{$this->idMensaje}" />
        $mensajeRetorno
        <button type="submit" ">Borrar</button>
        EOF;
        return $camposFormulario;
    }

    /**
     * Procesa los datos del formulario.
     */
    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];
        $app = Aplicacion::getInstance();

        $idMensaje = \filter_var($datos['idMensaje'] ?? null, FILTER_SANITIZE_NUMBER_INT);
        if (!$idMensaje)
            $this->errores[] = 'No tengo claro que mensaje actualizar.';

        $idMensajeRetorno = \filter_var($datos['idMensajeRetorno'] ?? null, FILTER_SANITIZE_NUMBER_INT);

        if (count($this->errores) > 0) {
            return;
        }

        $mensaje = Mensaje::buscaxID($idMensaje);
        $idforo = $mensaje->getIDForo(); 
        if ($app->usuarioLogueado() && ($app->idUsuario() == $mensaje->getIDUsuario())) {
            $mensaje->borrate();
        }

        if ($idMensajeRetorno) {
            $this->urlRedireccion = $app->buildUrl("/foroaux.php?idforo=$idforo", ['id' => $idMensajeRetorno]);
        } else {
            $this->urlRedireccion = $app->buildUrl('/foros.php');
        }
    }
}
