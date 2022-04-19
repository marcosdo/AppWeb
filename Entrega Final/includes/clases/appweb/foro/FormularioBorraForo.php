<?php

namespace appweb\foro;

use appweb\Aplicacion;
use appweb\Formulario;
use appweb\foro\Mensaje;

class FormularioBorraForo extends Formulario {
    private $idforo;

    public function __construct($idforo = -1) {
        parent::__construct('formBorraForo', ['class' => 'inline', 'formId' => $idforo, 'urlRedireccion' => 'foros.php']);
        $this->idforo = $idforo;
    }

    protected function generaCamposFormulario(&$datos) {
        $camposFormulario = <<<EOF
        <input type="hidden" name="idforo" value="{$this->idforo}" />
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

        $idforo = filter_var($datos['idforo'] ?? null, FILTER_SANITIZE_NUMBER_INT);
        if (!$idforo)
            $this->errores[] = 'No tengo claro que mensaje actualizar.';

        if (count($this->errores) === 0) {
            $foro = Foro::buscaxID($idforo);
            $idforo = $foro->getID();
            if ($app->usuarioLogueado() && ($app->idUsuario() == $foro->getIDUsuario()) || $app->esAdmin()) {
                $foro->borrate();
            }
        }
    }
}
