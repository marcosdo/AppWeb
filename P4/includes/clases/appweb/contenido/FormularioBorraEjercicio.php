<?php

namespace appweb\contenido;

use appweb\Aplicacion;
use appweb\Formulario;
use appweb\contenido\Ejercicios;

class FormularioBorraEjercicio extends Formulario {
    private $idejercicio;

    public function __construct($idejercicio = -1) {
        parent::__construct('formBorraEjercicio', ['urlRedireccion' => 'ejercicios.php']);
        $this->idejercicio = $idejercicio;
    }

    protected function generaCamposFormulario(&$datos) {
        $camposFormulario = <<<EOF
        <input type="hidden" name="idejercicio" value="{$this->idejercicio}" />
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

        $idejercicio = filter_var($datos['idejercicio'] ?? null, FILTER_SANITIZE_NUMBER_INT);
        if (!$idejercicio)
            $this->errores[] = 'No tengo claro que ejercicio actualizar.';

        if (count($this->errores) === 0) {
            try{
            $ejercicio = Ejercicios::buscaxID($idejercicio);

            if ($app->usuarioLogueado() && $app->esProfesional()) {
                $ejercicio->borrate();
            }
            $app = Aplicacion::getInstance();
                $mensajes = ['Se ha borrado el ejercicio'];
                $app->putAtributoPeticion('mensajes', $mensajes);
            }
            catch (\Exception $e) {
                $this->errores[] = 'No se puede eliminar el ejercicio.';
            }
        }
    }
}
