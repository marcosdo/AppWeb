<?php
require_once __DIR__.'/includes/config.php';

//Doble seguridad: unset + destroy
unset($_SESSION['login']);
unset($_SESSION['nutri']);
unset($_SESSION['nombre']);
unset($_SESSION['id']);

session_destroy();

$tituloPagina = 'Logout';

$contenidoPrincipal = <<<EOS
<h1>Página Logout</h1>
<p>Gracias por visitar nuestra web. ¡Hasta pronto!</p>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';