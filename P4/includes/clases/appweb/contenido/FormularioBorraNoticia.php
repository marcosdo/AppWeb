<?php

namespace appweb\contenido;

use appweb\Aplicacion;
use appweb\Formulario;
use appweb\contenido\Noticias;

class FormularioBorraNoticia extends Formulario {
    private $idnoticia;

    public function __construct($idnoticia = -1) {
        parent::__construct('formBorraNoticia', ['urlRedireccion' => 'noticias.php']);
        $this->idnoticia = $idnoticia;
    }

    protected function generaCamposFormulario(&$datos) {
        $camposFormulario = <<<EOF
        <input type="hidden" name="idnoticia" value="{$this->idnoticia}" />
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

        $idnoticia = filter_var($datos['idnoticia'] ?? null, FILTER_SANITIZE_NUMBER_INT);
        if (!$idnoticia)
            $this->errores[] = 'No tengo claro que noticia actualizar.';

        if (count($this->errores) === 0) {
            try {
                $noticia = Noticias::buscaxID($idnoticia);

                if ($app->usuarioLogueado() && $app->esProfesional()) {
                    $noticia->borrate();
                }
                $app = Aplicacion::getInstance();
                $mensajes = ['Se ha borrado la noticia'];
                $app->putAtributoPeticion('mensajes', $mensajes);
            }
            catch (\Exception $e) {
                $this->errores[] = 'No se puede eliminar la noticia.';
            }
        }
    }
}
