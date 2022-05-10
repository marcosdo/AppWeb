<?php

namespace appweb\foro;

use appweb\Aplicacion;
use appweb\Formulario;
use appweb\foro\Mensaje;
use Exception;

class FormularioDislike extends Formulario {
    private $idMensaje;
   

    public function __construct($idMensaje = -1) {
        parent::__construct('formDislike', ['class' => 'inline', 'formId' => $idMensaje]);
        $this->idMensaje = $idMensaje;
      
    }

    protected function generaCamposFormulario(&$datos) {
        
        $camposFormulario = <<<EOF
        <button class="inline-button" type="submit"><i class="fa-solid fa-heart-crack"></i></button>
        EOF;
        return $camposFormulario;
    }

    /**
     * Procesa los datos del formulario.
     */
    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        if (count($this->errores) === 0) {
            $app = Aplicacion::getInstance();
            $mensaje = Mensaje::buscaxID($this->idMensaje);
            try{
                $mensaje->dislike();
            } catch(Exception $e){
                $this->errores[] = "Solo pudes dar dislike a un mensaje que has dado like previamente";
            }
    
            
            $this->urlRedireccion = $app->buildUrl('/foromensajes.php', ['id' => $this->idMensaje]);
           
        }
    }
}
