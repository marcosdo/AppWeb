<?php
namespace appweb\contenido;

use appweb\Formulario;
use appweb\Aplicacion;


class FormularioContenidoPrincipal extends Formulario {
    public function __construct() {
        parent::__construct('formContenido');
    }

    protected function generaCamposFormulario(&$datos) {
        $ruta = RUTA_IMGS;
        $html = <<<EOF
        <div class=contenido>
            <div id=recetas>
                <div>
                    <img src=$ruta/recetasCPP.png alt="recetas">
                </div>
                <div>
                    <button type="submit" name="recetas">RECETAS</button>
                </div>
            </div>
            <div id=noticias>
                <div>
                    <img src=$ruta/noticiasCPP.png alt="noticias">
                </div>
                <div>
                    <button type="submit" name="noticias">NOTICIAS</button>
                </div>
            </div>
            <div id=ejercicios>
                <div>
                    <img src=$ruta/ejerciciosCPPaux.png alt="ejercicios">
                </div>
                <div>
                    <button type="submit" name="ejercicios">EJERCICIOS</button>
                </div>
            </div>
        <div>
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