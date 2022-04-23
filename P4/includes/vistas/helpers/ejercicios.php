<?php
use appweb\Aplicacion;


function muestraEjercicio($ejercicio) {
   $app = Aplicacion::getInstance();
   $verURL = $app->buildUrl('ejercicio.php', [
       'id' => $ejercicio['id_ejercicio']
   ]);
   $ruta = RUTA_IMGS;
   return <<<EOS
   <a href="{$verURL}">
        <h4> {$ejercicio['nombre']} </h4>
        <p> <img src="$ruta/ejercicios/$ejercicio[id_ejercicio].png" alt="LIFETY"> </p>
    </a>
   EOS;
}


function listaListaEjerciciosPaginadas($ejercicios, $url, $numPorPagina = 18, $numPagina = 1) {
    return listaListaejerciciosPaginadasRecursivo($ejercicios, $url,  1, $numPorPagina, $numPagina);
}

function listaListaEjerciciosPaginadasRecursivo($ejercicios, $url, $nivel = 1, $numPorPagina = 18, $numPagina = 1) {
    $primerejercicio = ($numPagina - 1) * $numPorPagina;
    $app = Aplicacion::getInstance();
    $numejercicios = count($ejercicios);
    if ($numejercicios == 0) {
        return '';
    }

    $haySiguientePagina = false;
    if ($numejercicios > $numPorPagina + $primerejercicio) {
        $haySiguientePagina = true;
    }

    $html = '<div class=ejercicios><ul>';
    $html .= '<div class="fila">'; //MOSTRAR 3 EJERCICIOS EN UNA FILA :)
    $auxiliar = 0; 
    for($idx = $primerejercicio; $idx < $primerejercicio + $numPorPagina && $idx < $numejercicios; $idx++) {
        $auxiliar += 1;
        $ejercicio = $ejercicios[$idx];
        $html .= '<li>';
        $html .= muestraEjercicio($ejercicio);
        if($auxiliar == 3){
            $auxiliar = 0;
            $html .= '</div><div>';
        }
        
    }
    $html .= '</div>';
    $html .= '</ul></div>';

    if ($nivel == 1) {
        // Controles de paginacion
        $clasesPrevia='deshabilitado';
        $clasesSiguiente = 'deshabilitado';
        $hrefPrevia = '';
        $hrefSiguiente = '';

        if ($numPagina > 1) {
            // Seguro que hay ejercicios anteriores
            $paginaPrevia = $numPagina - 1;
            $clasesPrevia = '';
            $hrefPrevia = $app->buildUrl($url,[
                'numPagina' => $paginaPrevia,
                'numPorPagina' => $numPorPagina
            ]);
        }

        if ($haySiguientePagina) {
            // Puede que haya ejercicios posteriores
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