<?php
use appweb\Aplicacion;
use appweb\foro\Mensaje;
use appweb\foro\FormularioBorraMensaje;
use appweb\foro\FormularioEditaMensaje;
use appweb\usuarios\Personas;

/**
 * Crea html de un solo mensaje (a partir de un array)
 * @param array $mensaje Mensaje con el contenido que se quiere mostrar
 * @return html
 */
function visualizaMensaje($mensaje) {
    $app = Aplicacion::getInstance();
    $verURL = $app->buildUrl("mensajes.php", [
        "id" => $mensaje['id_mensaje']
    ]);
    $user = Personas::buscaPorId($mensaje['id_usuario']);
    $nick = $user->getAlias();

    return <<<EOS
    <a href="{$verURL}">
        <div id ="mensaje">
            <div id="msg-titulo">
                <h3>{$mensaje['titulo']}</h3>
            </div>
            <p id="msg-contenido">
                {$mensaje['mensaje']}
            </p>
            <div id="msg-datos">
                Autor: {$nick} | Fecha: {$mensaje['fecha']}
            </div>
        </div> 
    </a>
    EOS;
}

/**
 *Crea html de un solo mensaje (a partir de un objeto)
 * @param \mensaje $mensaje Mensaje con el contenido que se quiere mostrar
 * @return html
 */
function visualizaMensajeObjeto($mensaje) {
    $app = Aplicacion::getInstance();
    $verURL = $app->buildUrl("mensajes.php", [
        "id" => $mensaje->getID()
    ]);
    return <<<EOS
    <div id="mensajeObjeto">
        <a href="{$verURL}">
            {$mensaje->getTitulo()} ({$mensaje->getID()}) ({$mensaje->getFecha()})
        </a>
        <p>
            {$mensaje->getMensaje()}
        </p>
    </div>
    EOS;
}

/**
 * Crea html de un boton para editar el mensaje (a partir de un array)
 * @param array $mensaje                        Mensaje con el contenido que se quiere mostrar
 * @param int   $idMensajeRetorno   (opcional)  ID del mensaje padre
 * @return html
 */
function botonEditaMensaje($mensaje, $idMensajeRetorno = null) {
    $form = new FormularioEditaMensaje($mensaje['id_mensaje'], $idMensajeRetorno);
    return $form->gestiona();
}

/**
 * Crea html de un boton para editar el mensaje (a partir de un objeto)
 * @param \mensaje $mensaje                        Mensaje con el contenido que se quiere mostrar
 * @param int       $idMensajeRetorno   (opcional)  ID del mensaje padre
 * @return html
 */
function botonEditaMensajeObjeto($mensaje, $idMensajeRetorno = null) {
    $form = new FormularioEditaMensaje($mensaje->getID(), $idMensajeRetorno);
    return $form->gestiona();
}

/**
 * Crea html de un boton para borrar el mensaje (a partir de un array)
 * @param array $mensaje                        Mensaje con el contenido que se quiere mostrar
 * @param int   $idMensajeRetorno   (opcional)  ID del mensaje padre
 * @return html
 */
function botonBorraMensaje($mensaje, $idMensajeRetorno = null) {
    $formBorra = new FormularioBorraMensaje($mensaje['id_mensaje'], $idMensajeRetorno);
    return $formBorra->gestiona();
}

/**
 * Crea html de un boton para borrar el mensaje (a partir de un objeto)
 * @param \mensaje $mensaje                        Mensaje con el contenido que se quiere mostrar
 * @param int       $idMensajeRetorno   (opcional)  ID del mensaje padre
 * @return html
 */
function botonBorraMensajeObjecto($mensaje, $idMensajeRetorno = null) {
    $formBorra = new FormularioBorraMensaje($mensaje->getID(), $idMensajeRetorno);
    return $formBorra->gestiona();
}

/**
 * Crea html de una lista <ul> con cada mensaje en ese nivel
 * @param int   $id                 (opcional) ID del mensaje actual
 * @param bool  $recursivo          (opcional) si es recursivo se mostraran indentados
 * @param int   $idMensajeRetorno   (opcional) ID del mensaje padre
 * @return html
 */
function listaMensajes($id = NULL, $recursivo = false, $idMensajeRetorno = null) {
    $mensajes = Mensaje::buscaPorMensajePadre($id);
    if (count($mensajes) == 0) {
        return "";
    }

    $app = Aplicacion::getInstance();
    $html = "<ul class='listamensajes'>";
    foreach($mensajes as $mensaje) {
        $html .= "<li class='estilomensaje'>";
        $html .= visualizaMensajeObjeto($mensaje);
        if ($app->usuarioLogueado() && ($app->idUsuario() == $mensaje->getIDUsuario()) || $app->esAdmin()) {
            $html .= "<div class='msg'>";
            if (!$app->esAdmin())
                $html .= botonEditaMensajeObjeto($mensaje, $idMensajeRetorno);
            $html .= botonBorraMensajeObjecto($mensaje, $idMensajeRetorno);
            $html .= "</div>";
        }

        if ($recursivo) {
            $html .= listaMensajes($mensaje->getId(), $recursivo, $idMensajeRetorno);
        }
        $html .= "</li>";
    }
    $html .= "</ul>";

    return $html;
}

/**
 * Crea html de una lista <ul> con cada mensaje en ese nivel con dos botones para avanzar y retroceder si hay muchos mensajes
 * @param array     $mensajes           array de objetos mensajes que se quieren mostrar
 * @param bool      $recursivo          (opcional) si es recursivo se mostraran indentados
 * @param int       $idMensajeRetorno   (opcional) ID del mensaje padre
 * @param string    $url                (opcional) URL a donde se redireccionara despues de avanzar o retroceder al mostrar los mensajes
 * @param array     $extraUrlParams     (opcional) parametros de la URL
 * @param int       $nivel              (opcional) nivel de recursividad en el que nos encontramos
 * @param int       $numPorPagina       (opcional) numero de mensajes por cada pagina
 * @param int       $numPagina          (opcional) numero de pagina en el que nos encontramos
 * @return html
 */
function listaListaMensajesPaginados($mensajes, $recursivo = false, $idMensajeRetorno = null, $url="mensajes.php", $extraUrlParams = [], $numPorPagina = 5, $numPagina = 1) {
    return listaListaMensajesPaginadosRecursivo($mensajes, $recursivo, $idMensajeRetorno, $url, $extraUrlParams, 1, $numPorPagina, $numPagina);
}

/**
 * Crea html de una lista <ul> con cada mensaje en ese nivel con dos botones para avanzar y retroceder si hay muchos mensajes
 * @param array     $mensajes           array de objetos mensajes que se quieren mostrar
 * @param bool      $recursivo          (opcional) si es recursivo se mostraran indentados
 * @param int       $idMensajeRetorno   (opcional) ID del mensaje padre
 * @param string    $url                (opcional) URL a donde se redireccionara despues de avanzar o retroceder al mostrar los mensajes
 * @param array     $extraUrlParams     (opcional) parametros de la URL
 * @param int       $nivel              (opcional) nivel de recursividad en el que nos encontramos
 * @param int       $numPorPagina       (opcional) numero de mensajes por cada pagina
 * @param int       $numPagina          (opcional) numero de pagina en el que nos encontramos
 * @return html
 */
function listaListaMensajesPaginadosRecursivo($mensajes, $recursivo = false, $idMensajeRetorno = null, $url="mensajes.php", $extraUrlParams = [], $nivel = 1, $numPorPagina = 5, $numPagina = 1) {
    $primerMensaje = ($numPagina - 1) * $numPorPagina;
    $app = Aplicacion::getInstance();
    $numMensajes = count($mensajes);
    if ($numMensajes == 0)
        return "";
    
    $nPaginas = $numMensajes / $numPorPagina;
    $nPaginas = round($nPaginas, 0, PHP_ROUND_HALF_UP);

    $haySiguientePagina = false;
    if ($numMensajes > $numPorPagina + $primerMensaje) {
        $haySiguientePagina = true;
    }

    $html = "<ul class=listamensajes>";
    for($idx = $primerMensaje; $idx < $primerMensaje + $numPorPagina && $idx < $numMensajes; $idx++) {
        $mensaje = $mensajes[$idx];
        $html .= "<li class=estilomensaje>";
        $html .= visualizaMensaje($mensaje);
        if ($app->usuarioLogueado() && ($app->idUsuario() == $mensaje['id_usuario']) || $app->esAdmin()) {
            $html .= "<div class=msg>";
            if (!$app->esAdmin())
                $html .= botonEditaMensaje($mensaje, $idMensajeRetorno);
                $html .= botonBorraMensaje($mensaje, $idMensajeRetorno);
                $html .= "</div>";
        }
        if ($recursivo) {
            //$html .= listaMensajesPaginadosRecursivo($mensaje['id'], $recursivo, $idMensajeRetorno, $nivel+1, $numPagina, $numPorPagina);
        }
        $html .= "</li>";
    }
    $html .= "</ul>";

    if ($nivel == 1) {
        // Controles de paginacion
        $clasesPrevia="deshabilitado";
        $clasesSiguiente = "deshabilitado";
        $hrefPrevia = "";
        $hrefSiguiente = "";

        if ($numPagina > 1) {
            // Seguro que hay mensajes anteriores
            $paginaPrevia = $numPagina - 1;
            $clasesPrevia = "";
            $hrefPrevia = $app->buildUrl($url, array_merge($extraUrlParams, [
                "id" => $idMensajeRetorno,
                "numPagina" => $paginaPrevia,
                "numPorPagina" => $numPorPagina
            ]));
        }

        if ($haySiguientePagina) {
            // Puede que haya mensajes posteriores
            $paginaSiguiente = $numPagina + 1;
            $clasesSiguiente = "";
            $hrefSiguiente = $app->buildUrl($url, array_merge($extraUrlParams, [
                "id" => $idMensajeRetorno,
                "numPagina" => $paginaSiguiente,
                "numPorPagina" => $numPorPagina
            ]));
        }
        
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