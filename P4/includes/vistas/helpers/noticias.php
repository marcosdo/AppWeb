<?php
use appweb\Aplicacion;
use appweb\contenido\Noticias;

function muestraNoticia($noticia) {
   // $html = "<h4>".$titulo[$i]."</h4>"; //PONER AQUI REFERENCIA :))
   // return $html;
}


function listaListaNoticiasPaginadas($noticias, $url, $numPorPagina = 5, $numPagina = 1) {
    return listaListaNoticiasPaginadasRecursivo($noticias, $url,  1, $numPorPagina, $numPagina);
}

function listaListaNoticiasPaginadasRecursivo($noticias, $url, $nivel = 1, $numPorPagina = 5, $numPagina = 1) {
    $primerNoticia = ($numPagina - 1) * $numPorPagina;
    $app = Aplicacion::getInstance();
    $numNoticias = count($noticias);
    if ($numNoticias == 0) {
        return '';
    }

    $haySiguientePagina = false;
    if ($numNoticias > $numPorPagina + $primerNoticia) {
        $haySiguientePagina = true;
    }

    $html = '<div class=noticias><ul>';
    for($idx = $primerNoticia; $idx < $primerNoticia + $numPorPagina && $idx < $numNoticias; $idx++) {
        $noticia = $noticias[$idx];
        $html .= '<li>';
        $html .= muestraNoticia($noticia);
        
    }
    $html .= '</ul></div>';

    if ($nivel == 1) {
        // Controles de paginacion
        $clasesPrevia='deshabilitado';
        $clasesSiguiente = 'deshabilitado';
        $hrefPrevia = '';
        $hrefSiguiente = '';

        if ($numPagina > 1) {
            // Seguro que hay noticias anteriores
            $paginaPrevia = $numPagina - 1;
            $clasesPrevia = '';
            $hrefPrevia = $app->buildUrl($url,[
                'numPagina' => $paginaPrevia,
                'numPorPagina' => $numPorPagina
            ]);
        }

        if ($haySiguientePagina) {
            // Puede que haya noticias posteriores
            $paginaSiguiente = $numPagina + 1;
            $clasesSiguiente = '';
            $hrefSiguiente = $app->buildUrl($url, [ 
            'numPagina' => $paginaSiguiente,
            'numPorPagina' => $numPorPagina]);
        }

        $html .=<<<EOS
            <div>
                Página: $numPagina, <a class="boton $clasesPrevia" href="$hrefPrevia">Previa</a> <a class="boton $clasesSiguiente" href="$hrefSiguiente">Siguiente</a>
            </div>
        EOS;
    }

    return $html;
}