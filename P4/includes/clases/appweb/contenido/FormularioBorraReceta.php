<?php

namespace appweb\contenido;

use appweb\Aplicacion;
use appweb\Formulario;
use appweb\contenido\Comidas;

class FormularioBorraReceta extends Formulario {
    private $idreceta;

    public function __construct($idreceta = -1) {
        parent::__construct('formBorraReceta', ['urlRedireccion' => 'recetas.php']);
        $this->idreceta = $idreceta;
    }

    protected function generaCamposFormulario(&$datos) {
        $camposFormulario = <<<EOF
        <input type="hidden" name="idreceta" value="{$this->idreceta}" />
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

        $idreceta = filter_var($datos['idreceta'] ?? null, FILTER_SANITIZE_NUMBER_INT);
        if (!$idreceta)
            $this->errores[] = 'No tengo claro que receta actualizar.';

        if (count($this->errores) === 0) {
            try {
                $comida = Comidas::buscaxID($idreceta);
    
                if ($app->usuarioLogueado() && $app->esProfesional()) {
                    $comida->borrate();
                }

                $app = Aplicacion::getInstance();
                $mensajes = ['Se ha borrado la comida'];
                $app->putAtributoPeticion('mensajes', $mensajes);
            }
            catch (\Exception $e) {
                $this->errores[] = 'No se puede eliminar la receta.';
            }
        }
    }
}
