<?php
use appweb\Aplicacion;
use appweb\usuarios\Usuario;

require_once __DIR__.'/includes/config.php';

$app = Aplicacion::getInstance();
$myID = $app->idUsuario();
$user = Usuario::buscaPorId($myID);
if($user){
    $formContenido = new appweb\usuarios\FormularioEditaUsuario($user);
    $htmlFormContenido = $formContenido->gestiona();
}

$tituloPagina = 'Mi Cuenta';
$contenidoPrincipal = <<<EOS
    <h1>Esta es la informacion de tu cuenta en LIFETY</h1>
    <div id=cuenta>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <h4 class="message"><a href='#'>Editar datos de la cuenta. <i class="fa-solid fa-pen-to-square"></i></a></h4>
    </div>
    $htmlFormContenido
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';
