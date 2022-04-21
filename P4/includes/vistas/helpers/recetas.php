<?php
use appweb\Aplicacion;
use appweb\contenido\Comidas;

function muestraReceta() {
    $app = Aplicacion::getInstance();
    $data = Comidas::getData();
    $descripcion = array_column($data, 'descripcion');
    $link = array_column($data, 'link');

    $html = "<div class=recetas><h3>Todas las recetas</h3><ul>";
    for ($i = 0; $i < count($data); $i++) {
        $html .= "<li>";
        $html .= "<h4>".$descripcion[$i]."</h4>";
        $html .= "<iframe src='https://www.youtube.com/embed/$link[$i]'></iframe>";
        $html .= "</li>";
    }
    $html .= "</ul></div>";
    return $html;
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
        $html .= "<h4>".$descripcion[$idx]."</h4>";
        $html .= "<iframe src='https://www.youtube.com/embed/$link[$idx]'></iframe>";
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