<?php
namespace appweb\contenido;

use appweb\Formulario;
use appweb\Aplicacion;


class FormularioContenidoPrincipal extends Formulario {
    public function __construct() {
        parent::__construct('formContenido');
    }

    protected function generaCamposFormulario(&$datos) {
        $html = <<<EOF
        <button type="submit" name="recetas">RECETAS</button>
        <button type="submit" name="noticias">NOTICIAS</button>
        <button type="submit" name="ejercicios">EJERCICIOS</button>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) { 
        $app = Aplicacion::getInstance();
        if(isset($_POST['recetas'])){
            $this->urlRedireccion = $app->buildUrl('/recetas.php');
        }
        else if(isset($_POST['noticias'])){
            $this->urlRedireccion = $app->buildUrl('/noticias.php');
        }
        else {
            $this->urlRedireccion = $app->buildUrl('/ejercicios.php');
        }
    }
}