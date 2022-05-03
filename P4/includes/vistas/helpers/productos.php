<?php
use appweb\Aplicacion;


function muestraProducto($producto) {
    $app = Aplicacion::getInstance();
    $verURL = $app->buildUrl('producto.php', [
        'id' => $producto['id_producto']
    ]);
    $ruta = RUTA_IMGS;
    return <<<EOS
    <a href="{$verURL}">
         <h4 class='nombre-producto'> {$producto['nombre']} </h4>
         <div class='imagen-producto'><img src="$ruta/productos/$producto[id_producto].png" alt="LIFETY"></div>
     </a>
     <h4 class='precio-producto'> {$producto['precio']} </h4>
    EOS;
 }

 function listaListaProductosPaginadas($productos, $url, $numPorPagina = 9, $numPagina = 1) {
    return listaListaProductosPaginadasRecursivo($productos, $url,  1, $numPorPagina, $numPagina);
}

function listaListaProductosPaginadasRecursivo($productos, $url, $nivel = 1, $numPorPagina = 9, $numPagina = 1) {
    $primerproducto = ($numPagina - 1) * $numPorPagina;
    $app = Aplicacion::getInstance();
    $numproductos = count($productos);
    if ($productos == 0) {
        return '';
    }

    $haySiguientePagina = false;
    if ($numproductos > $numPorPagina + $primerproducto) {
        $haySiguientePagina = true;
    }

    

    $html = "<h2>Ver Productos</h2><div class ='productos-layout'>";
    $auxiliar = 0; 
    for($idx = $primerproducto; $idx < $primerproducto + $numPorPagina && $idx < $numproductos; $idx++) {
        if(!$auxiliar) $html .= '<div class="row-producto">';
        $id= 'row'.$auxiliar;
        $html .= "<div class = 'producto'>";

        //$html .= "<div id=$id>";
        $auxiliar += 1;
        $productoi = $productos[$idx];
        $html .= muestraProducto($productoi);
        
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