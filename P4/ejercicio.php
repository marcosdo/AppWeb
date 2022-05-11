<?php
	use appweb\Aplicacion;
	require_once __DIR__.'/includes/config.php';
	$app = Aplicacion::getInstance();
	if ($app->usuarioLogueado() == true){
		// Coger los parametros $_GET: ?id=n, y si no existe redirigir al index
		$idEjercicio = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
		if (!$idEjercicio) {
			appweb\Aplicacion::redirige($app->buildUrl('/ejercicios.php'));
		}

		$ejercicio = appweb\contenido\Ejercicios::buscaxID($idEjercicio);
		if (!$ejercicio) {
			appweb\Aplicacion::redirige($app->buildUrl('/ejercicios.php'));
		}

		$tituloPagina = 'Ejercicio';

		$imagen = $ejercicio->getId_ejercicio();
		$nombre = $ejercicio->getNombre();
		$descripcion = $ejercicio->getDescripcion();
		$musculo = $ejercicio->getMusculo();
		$tipo = $ejercicio->getTipo();
		$ruta = RUTA_IMGS;


		$app = Aplicacion::getInstance();

		if($app->esProfesional()){
			$formEdita = new appweb\contenido\FormularioEditaEjercicio($idEjercicio);
			$htmlFormEdita = "<h4 class='message'><a href='#'>Edita este ejercicio. <i class='fa-solid fa-pen-to-square'></i></a></h4>";
			$htmlFormEdita .= $formEdita->gestiona();
		}
		else $htmlFormEdita='';

		switch($tipo) {
			case 0: $aux = "fuerza"; break;
			case 1: $aux = "hipertrofia"; break;
			case 2: $aux = "resistencia"; break;
		}
		$contenidoPrincipal = <<<EOS
		<h1>{$nombre}</h1>
		<div id='ejercicio'>
			<img src="$ruta/ejercicios/$imagen.png" alt="LIFETY">
			<h4>Musculo entrenado: {$musculo}</h4>
			<h4>Util para mejorar la {$aux}</h4>
			<p>{$descripcion}</p>
			$htmlFormEdita
		</div>
		EOS;
	}
	else {
		header('Location: login.php');
		exit();
	}
require __DIR__.'/includes/vistas/plantillas/plantilla.php';