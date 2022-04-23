<?php
use appweb\Aplicacion;
use appweb\contenido\FormularioBorraReceta;

function muestraReceta($receta) {
    $html = "<h1>".$receta["descripcion"]."</h1>";
    $html .= "<iframe src='https://www.youtube.com/embed/$receta[link]'></iframe>";
    return $html;
}

function botonBorraReceta($receta) {
    $form = new  FormularioBorraReceta($receta['id_comida']);
    return $form->gestiona();
}

function listaListaRecetasPaginadas($recetas, $url, $numPorPagina = 3, $numPagina = 1) {
    return listaListaRecetasPaginadasRecursivo($recetas, $url, 1, $numPorPagina, $numPagina);
}

function listaListaRecetasPaginadasRecursivo($recetas,  $url, $nivel = 1, $numPorPagina = 3, $numPagina = 1) {
    $primeraReceta = ($numPagina - 1) * $numPorPagina;
    $app = Aplicacion::getInstance();
    $numRecetas = count($recetas);
    if ($numRecetas == 0) {
        return '';
    }

    $haySiguientePagina = false;
    if ($numRecetas > $numPorPagina + $primeraReceta) {
        $haySiguientePagina = true;
    }

    $descripcion = array_column($recetas, 'descripcion');
    $link = array_column($recetas, 'link');
    
    $html = '<div class=recetas><ul>';
    for($idx = $primeraReceta; $idx < $primeraReceta + $numPorPagina && $idx < $numRecetas; $idx++) {
        $receta = $recetas[$idx];
        $html .= '<li>';
        $html .= muestraReceta($receta);
        if($app->esProfesional()){
            $html .= botonBorraReceta($receta);
        }
        $html .= '</li>';
    }
    $html .= '</ul></div>';

    if ($nivel == 1) {
        // Controles de paginacion
        $clasesPrevia='deshabilitado';
        $clasesSiguiente = 'deshabilitado';
        $hrefPrevia = '';
        $hrefSiguiente = '';

        if ($numPagina > 1) {
            // Seguro que hay Recetas anteriores
            $paginaPrevia = $numPagina - 1;
            $clasesPrevia = '';
            $hrefPrevia = $app->buildUrl($url, [
                'numPagina' => $paginaPrevia,
                'numPorPagina' => $numPorPagina
            ]);
        }

        if ($haySiguientePagina) {
            // Puede que haya Recetas posteriores
            $paginaSiguiente = $numPagina + 1;
            $clasesSiguiente = '';
            $hrefSiguiente = $app->buildUrl($url,[
                'numPagina' => $paginaSiguiente,
                'numPorPagina' => $numPorPagina
            ]);
        }

        $html .=<<<EOS
            <div>
                Página: $numPagina, <a class="boton $clasesPrevia" href="$hrefPrevia">Previa</a> <a class="boton $clasesSiguiente" href="$hrefSiguiente">Siguiente</a>
            </div>
        EOS;
    }

    return $html;
}