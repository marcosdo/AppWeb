<?php
use appweb\foro\Mensaje;
use appweb\foro\FormularioBorraMensaje;
use appweb\Aplicacion;

function visualizaMensaje($mensaje) {
    $app = Aplicacion::getInstance();
    $verURL = $app->buildUrl('mensajes.php', [
        'id' => $mensaje['id_mensaje']
    ]);
    return <<<EOS
    <a href="{$verURL}">{$mensaje['titulo']} ({$mensaje['id_usuario']}) ({$mensaje['fecha']})</a>
    
    EOS;
}

function visualizaMensajeObjeto($mensaje) {
    $app = Aplicacion::getInstance();
    $verURL = $app->buildUrl('mensajes.php', [
        'id' => $mensaje->getID()
    ]);
    return <<<EOS
    <a href="{$verURL}">{$mensaje->getTitulo()} ({$mensaje->getID()}) ({$mensaje->getID()})</a>

    EOS;
}

function botonEditaMensaje($mensaje, $idMensajeRetorno = null) {
    $app = Aplicacion::getInstance();
    $editaURL = $app->buildUrl('editarmensaje.php', [
        'id' => $mensaje->id,
        'idMensajeRetorno' => $idMensajeRetorno
    ]);
    return <<<EOS
    <a class="boton" href="{$editaURL}">Editar</a>
    EOS;
}

function botonBorraMensaje($mensaje, $idMensajeRetorno = null)
{
    $formBorra = new FormularioBorraMensaje($mensaje['id_mensaje'], $idMensajeRetorno);
    return $formBorra->gestiona();
}

// XXX Esta función es muy similar a la funcion listaMensajesPaginados y en un proyecto real sólo debería de existir una de ellas
function listaMensajes($id = NULL, $recursivo = false, $idMensajeRetorno = null)
{
    $mensajes = Mensaje::buscaPorMensajePadre($id);
    if (count($mensajes) == 0) {
        return '';
    }

    $app = Aplicacion::getInstance();
    $html = '<ul>';
    foreach($mensajes as $mensaje) {
        $html .= '<li>';
        $html .= visualizaMensajeObjeto($mensaje);
        /*if ($app->usuarioLogueado() && ($app->idUsuario() == $mensaje->idAutor || $app->esAdmin())) {
            $html .= botonEditaMensaje($mensaje, $idMensajeRetorno);
            $html .= botonBorraMensaje($mensaje, $idMensajeRetorno);
        }*/
        if ($recursivo) {
            $html .= listaMensajes($mensaje->getId(), $recursivo, $idMensajeRetorno);
        }
        $html .= '</li>';
    }
    $html .= '</ul>';

    return $html;
}

/*function listaMensajesPaginados($id = null, $recursivo = false, $idMensajeRetorno = null, $numPorPagina = 5, $numPagina = 1) {
    return listaMensajesPaginadosRecursivo($id, $recursivo, $idMensajeRetorno, 1, $numPorPagina, $numPagina);
}*/

function listaListaMensajesPaginados($mensajes, $recursivo = false, $idMensajeRetorno = null, $url='mensajes.php', $extraUrlParams = [], $numPorPagina = 5, $numPagina = 1) {
    return listaListaMensajesPaginadosRecursivo($mensajes, $recursivo, $idMensajeRetorno, $url, $extraUrlParams, 1, $numPorPagina, $numPagina);
}

/*function listaMensajesPaginadosRecursivo($id = null, $recursivo = false, $idMensajeRetorno = null, $nivel = 1, $numPorPagina = 5, $numPagina = 1)
{
    $mensajes = Mensaje::buscaPorMensajePadrePaginado($id, $numPorPagina+1, $numPagina-1);
    return listaListaMensajesPaginadosRecursivo($mensajes, $recursivo, $idMensajeRetorno, 'mensajes.php', [], $nivel, $numPorPagina, $numPagina);
}*/

function listaListaMensajesPaginadosRecursivo($mensajes, $recursivo = false, $idMensajeRetorno = null, $url='mensajes.php', $extraUrlParams = [], $nivel = 1, $numPorPagina = 5, $numPagina = 1)
{
    $primerMensaje = ($numPagina - 1) * $numPorPagina;
    $app = Aplicacion::getInstance();
    $numMensajes = count($mensajes);
    if ($numMensajes == 0) {
        return '';
    }

    $haySiguientePagina = false;
    if ($numMensajes > $numPorPagina + $primerMensaje) {
        $haySiguientePagina = true;
    }

    $html = '<ul>';
    for($idx = $primerMensaje; $idx < $primerMensaje + $numPorPagina && $idx < $numMensajes; $idx++) {
        $mensaje = $mensajes[$idx];
        $html .= '<li>';
        $html .= visualizaMensaje($mensaje);
        if ($app->usuarioLogueado() && ($app->idUsuario() == $mensaje['id_usuario'])) {
            //$html .= botonEditaMensaje($mensaje, $idMensajeRetorno);
            $html .= botonBorraMensaje($mensaje, $idMensajeRetorno);
        }
        if ($recursivo) {
            //$html .= listaMensajesPaginadosRecursivo($mensaje['id'], $recursivo, $idMensajeRetorno, $nivel+1, $numPagina, $numPorPagina);
        }
        $html .= '</li>';
    }
    $html .= '</ul>';

    if ($nivel == 1) {
        // Controles de paginacion
        $clasesPrevia='deshabilitado';
        $clasesSiguiente = 'deshabilitado';
        $hrefPrevia = '';
        $hrefSiguiente = '';

        if ($numPagina > 1) {
            // Seguro que hay mensajes anteriores
            $paginaPrevia = $numPagina - 1;
            $clasesPrevia = '';
            $hrefPrevia = $app->buildUrl($url, array_merge($extraUrlParams, [
                'id' => $idMensajeRetorno,
                'numPagina' => $paginaPrevia,
                'numPorPagina' => $numPorPagina
            ]));
        }

        if ($haySiguientePagina) {
            // Puede que haya mensajes posteriores
            $paginaSiguiente = $numPagina + 1;
            $clasesSiguiente = '';
            $hrefSiguiente = $app->buildUrl($url, array_merge($extraUrlParams, [
                'id' => $idMensajeRetorno,
                'numPagina' => $paginaSiguiente,
                'numPorPagina' => $numPorPagina
            ]));
        }

        $html .=<<<EOS
            <div>
                Página: $numPagina, <a class="boton $clasesPrevia" href="$hrefPrevia">Previa</a> <a class="boton $clasesSiguiente" href="$hrefSiguiente">Siguiente</a>
            </div>
        EOS;
    }

    return $html;
}

function mensajeForm($action, $label, $button, $idMensajeRetorno = null, $idMensajeActualizar = null, $mensajeActual='')
{
    $mensajeRetorno = '';
    if ($idMensajeRetorno != null) {
        $mensajeRetorno = <<<EOS
        <input type="hidden" name="idMensajeRetorno" value="{$idMensajeRetorno}" />
        EOS;
    }
    $mensajeActualizar = '';
    if ($idMensajeActualizar != null) {
        $mensajeActualizar = <<<EOS
        <input type="hidden" name="id" value="{$idMensajeActualizar}" />
        EOS;
    }

    $htmlForm = <<<EOS
    <form action="{$action}" method="POST">
        $mensajeActualizar
        $mensajeRetorno
        <fieldset>
            <div><label for="mensaje">{$label}</label><input id="mensaje" type="text" name="mensaje" value="{$mensajeActual}" /></div>
            <div><button type="submit">{$button}</button></div>
        </fieldset>
    </form>
    EOS;

    return $htmlForm;
}
