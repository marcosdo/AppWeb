<?php
use appweb\Aplicacion;
use appweb\foro\Mensaje;
use appweb\foro\FormularioBorraMensaje;
use appweb\foro\FormularioEditaMensaje;
use appweb\usuarios\Personas;

/**
 *Crea html de un solo mensaje (a partir de un objeto)
 * @param \mensaje $mensaje Mensaje con el contenido que se quiere mostrar
 * @return html
 */
function visualizaMensajeObjeto($mensaje) {
    $app = Aplicacion::getInstance();
    $user = Personas::buscaPorId($mensaje->getIDusuario());
    $verURL = $app->buildUrl("foromensajes.php", [
        "id" => $mensaje->getID()
    ]);

    $form1 = new appweb\foro\FormularioLike($mensaje->getID());
	$btnLike = $form1->gestiona();
	$form2 = new appweb\foro\FormularioDislike($mensaje->getID());
	$btnDislike = $form2->gestiona();

    return <<<EOS
    <a href="{$verURL}" id=lista>
    <div class="msg-objeto">
        <p id="msg-contenido">
        {$mensaje->getTitulo()}: {$mensaje->getMensaje()}
        </p>
        <div id="msg-datos">
            Autor: {$user->getAlias()} | Respuestas {$mensaje->getNumRespuestas()} | Likes: {$mensaje->getLikes()}
        </div> 
        </div>
        </a>
        <div class="msg-botones"> 
            $btnLike  <span> $btnDislike </span>
        </div>
    EOS;
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
        $html .=  "<div id=fondo-mensaje>";
        $html .= visualizaMensajeObjeto($mensaje);
        $html .= "</div>";

        if ($recursivo) {
            $html .= listaMensajes($mensaje->getId(), $recursivo, $idMensajeRetorno);
        }
        $html .= "</li>";
    }
    $html .= "</ul>";
    return $html;
}