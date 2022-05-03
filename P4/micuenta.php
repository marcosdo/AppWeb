<?
use appweb\Aplicacion;
use appweb\usuarios\Usuario;

$app = Aplicacion::getInstance();
$myID = $app->idUsuario();
$user = Usuario::buscaPorId($myID);

$tituloPagina = 'Mi Cuenta';
$contenidoPrincipal = <<<EOS
    <h3>Datos de la cuenta</h3>
EOS;