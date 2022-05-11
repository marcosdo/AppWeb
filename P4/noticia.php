<?php
	use appweb\Aplicacion;
	require_once __DIR__.'/includes/config.php';
	$app = Aplicacion::getInstance();
	if ($app->usuarioLogueado() == true){
	// Coger los parametros $_GET: ?id=n, y si no existe redirigir al index
	$idNoticia = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	if (!$idNoticia) {
		appweb\Aplicacion::redirige($app->buildUrl('/noticias.php'));
	}

	$noticia = appweb\contenido\Noticias::buscaxID($idNoticia);
	if (!$noticia) {
		appweb\Aplicacion::redirige($app->buildUrl('/noticias.php'));
	}
	$tituloPagina = 'Noticia';
	$app = Aplicacion::getInstance();

	if($app->esProfesional() && $noticia->getId_profesional()==$app->idUsuario()){
		$formEdita = new appweb\contenido\FormularioEditaNoticia($idNoticia);
		$htmlFormEdita = "<h4 class='message'><a href='#'>Edita este noticia para corrergir cualquier fallo. <i class='fa-solid fa-pen-to-square'></i></a></h4>";
		$htmlFormEdita .= $formEdita->gestiona();
	}
	else $htmlFormEdita='';

	$titulo = $noticia->getTitulo();
	$cuerpo = $noticia->getCuerpo();

	$contenidoPrincipal = <<<EOS
	<div id='noticia'>
		<h1>{$titulo}</h1>
		<p>{$cuerpo}</p>
		$htmlFormEdita
	</div>
	EOS;

}
else {
	header('Location: login.php');
	exit();
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';