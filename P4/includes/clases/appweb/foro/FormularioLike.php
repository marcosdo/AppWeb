<?php

namespace appweb\foro;

use appweb\Aplicacion;
use appweb\Formulario;
use appweb\foro\Mensaje;

class FormularioLike extends Formulario {
    private $idMensaje;

    public function __construct($idMensaje = -1) {
        $form = ($idMensaje != -1) ? "formLike" . $idMensaje : "formLike";
        parent::__construct($form);
        $this->idMensaje = $idMensaje;
       
    }

    protected function generaCamposFormulario(&$datos) {
        $camposFormulario = <<<EOF
            <button class="inline-button-like" type="submit"><i class="fa-solid fa-heart"></i></button>
        EOF;
        return $camposFormulario;
    }

    /**
     * Procesa los datos del formulario.
     */
    protected function procesaFormulario(&$datos) {
        $this->errores = [];
        $form = "formLike" . $this->idMensaje;
        if ($form == $this->formId) {
            $app = Aplicacion::getInstance();
            $mensaje = Mensaje::buscaxID($this->idMensaje);
            try {
                $mensaje->like();
                $origen = $mensaje->getMsgOrigen();
            }
            catch (\Exception $e) {
                $this->errores[] = "Ya has dado like a este mensaje";
            }
            $this->urlRedireccion = $app->buildUrl('/foromensajes.php', ['id' => $origen]);
            Aplicacion::redirige($this->urlRedireccion);
        }
    }
}
