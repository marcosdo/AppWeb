<?
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
    <h3>Datos de la cuenta</h3>
    $htmlFormContenido
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';