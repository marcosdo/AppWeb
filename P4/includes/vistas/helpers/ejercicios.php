<?php
use appweb\Aplicacion;
use appweb\contenido\FormularioBorraEjercicio;


function muestraEjercicio($ejercicio) {
   $app = Aplicacion::getInstance();
   $verURL = $app->buildUrl('ejercicio.php', [
       'id' => $ejercicio['id_ejercicio']
   ]);
   $ruta = RUTA_IMGS;
   return <<<EOS
   <a href="{$verURL}">
        <h4> {$ejercicio['nombre']} </h4>
        <img src="$ruta/ejercicios/$ejercicio[id_ejercicio].png" alt="LIFETY">
    </a>
   EOS;
}

function botonBorraEjercicio($ejercicio) {
    $form = new  FormularioBorraEjercicio($ejercicio['id_ejercicio']);
    return $form->gestiona();
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

    if($app->esProfesional()){
        $form = new appweb\contenido\FormularioCreaEjercicio();
        $html = $form->gestiona();
    }
    else $html = '';

    $html .= '<div class=ejercicios>';
     //MOSTRAR 3 EJERCICIOS EN UNA FILA :)
    $auxiliar = 0; 
    for($idx = $primerejercicio; $idx < $primerejercicio + $numPorPagina && $idx < $numejercicios; $idx++) {
        if(!$auxiliar) $html .= '<div class="fila">';
        $id= 'row'.$auxiliar;
        $html .= "<div id=$id>";
        $auxiliar += 1;
        $ejercicio = $ejercicios[$idx];
        $html .= muestraEjercicio($ejercicio);
        if($app->esProfesional()){
            $html .= botonBorraEjercicio($ejercicio);
        }
        $html .= '</div>';
        if($auxiliar == 3){
            $auxiliar = 0;
            $html .= '</div>';
        }
    }
    $html .= '</div>';

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
            <div id=paginas>
                Página: $numPagina, <a class="boton $clasesPrevia" href="$hrefPrevia">Previa</a> <a class="boton $clasesSiguiente" href="$hrefSiguiente">Siguiente</a>
            </div>
        EOS;
    }

    return $html;
}