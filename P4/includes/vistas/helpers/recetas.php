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
function FiltraProducto(){
    $filtra =  new appweb\contenido\FormularioFiltrarRecetas();
    return $filtra->gestiona();
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
    if($app->esProfesional()){
        $html = "<h4 class='message6'><a href='#'> Crea una receta. <i class='fa-solid fa-plus'></i></a></h4>";
        $form = new appweb\contenido\FormularioCreaReceta();
        $html .= $form->gestiona();
        $html .= "</div>";
    }
    else $html = '</div>';
    

    $descripcion = array_column($recetas, 'descripcion');
    $link = array_column($recetas, 'link');
    
    $html .= '<div class=recetas><ul>';
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
        $numrecetas = count($recetas);
        $nPaginas = $numrecetas / $numPorPagina;
        $nPaginas = ceil($nPaginas);
        $botonAnterior = ($numPagina != 1) ? "<a class='boton $clasesPrevia' href='$hrefPrevia'>Previa</a>" : "Primera";
        $botonSiguiente = ($haySiguientePagina) ? "<a class='boton $clasesSiguiente' href='$hrefSiguiente'>Siguiente</a>" : "Última";
        $html .=<<<EOS
            <div id=paginas>
                $botonAnterior
                | ($numPagina de $nPaginas) | 
                $botonSiguiente
            </div>
        EOS;
    }

    return $html;
}