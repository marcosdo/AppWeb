<?php
use appweb\Aplicacion;
use appweb\usuarios\Profesional;
use appweb\contenido\FormularioBorraNoticia;

function muestraNoticia($noticia, $clase) {
   $app = Aplicacion::getInstance();
   $verURL = $app->buildUrl('noticia.php', [
       'id' => $noticia['id_noticia']
   ]);
   $profesional = Profesional::buscaID($noticia['id_profesional']);
   return <<<EOS
   <div class = $clase>
    <a href="{$verURL}">
            <h4> {$noticia['titulo']} </h4>
                <p> Autor: {$profesional->getNick()} <span class='fecha'> Fecha: ({$noticia['fecha']}) </span</p>
            </p>
        </a>
    </div>
   EOS;
}

function botonBorraNoticia($noticia) {
    $form = new  FormularioBorraNoticia($noticia['id_noticia']);
    return $form->gestiona();
}

function listaListaNoticiasPaginadas($noticias, $url, $numPorPagina = 10, $numPagina = 1) {
    return listaListaNoticiasPaginadasRecursivo($noticias, $url,  1, $numPorPagina, $numPagina);
}

function listaListaNoticiasPaginadasRecursivo($noticias, $url, $nivel = 1, $numPorPagina = 10, $numPagina = 1) {
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
        if(($idx%2) == 0) $clase = "par";
        else $clase = "impar";
        $html .= '<li>';
        $html .= muestraNoticia($noticia, $clase);
        if($app->esProfesional()){
            $html .= botonBorraNoticia($noticia);
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