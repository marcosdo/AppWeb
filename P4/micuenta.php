<?php
use appweb\Aplicacion;
use appweb\usuarios\Personas;

require_once __DIR__.'/includes/config.php';

$app = Aplicacion::getInstance();
$myID = $app->idUsuario();
$user = Personas::buscaPorId($myID);
if($user){
    $formContenido = new appweb\usuarios\FormularioEditaUsuario();
    $htmlFormContenido = $formContenido->gestiona();
}

$alias = $user->getAlias();
$nombre = $user->getNombre();
$apellidos = $user->getApellidos();
$correo = $user->getCorreo();
$rol = $user->getRol();
$tituloPagina = 'Mi Cuenta';
$contenidoPrincipal = <<<EOS
    <h1>Esta es la informacion de tu cuenta en LIFETY</h1>
    <div id=cuenta>
    <p>Nombre de usuario: $alias</p>
    <p>Nombre real: $nombre</p>
    <p>Apellidos: $apellidos</p>
    <p>Direccion de correo: $correo</p>
    <p>Rol: $rol</p>
    <h4 class="message"><a href='#'>Editar datos de la cuenta. <i class="fa-solid fa-pen-to-square"></i></a></h4>
    </div>
    $htmlFormContenido
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';
