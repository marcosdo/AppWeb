<?php

  require_once __DIR__.'/includes/config.php';

  $tituloPagina = 'Portada';

  $contenidoPrincipal = <<<EOS
  <h1 class="title_portada"> BREAK YOUR LIMITS </h1>
  

  <div class="container_portada">

    <h1 class="title_portada2"> "El deporte consiste en dotar al cuerpo de algunas de las virtudes más fuertes del alma:
    la energía, la audacia y la paciencia" Jean Giraudoux, escritor francés. </h1>
    <img src="src/img/entrenamiento.jpg" alt="LIFETY">
    <p> El ejercicio físico es ampliamente reconocido como un pilar de la vida saludable. 
    Esta consideración se debe a que el ejercicio puede prevenir problemas de salud, ayudar a desarrollar resistencia física, obtener más energía y ayudar a reducir el estrés. 
    También puede facilitar el mantenimiento de un peso corporal saludable y el control del apetito.</p>
    <p> Practicar deporte es muy importante para el ser humano, 
    sea cual sea su edad. Consiste en dedicar una parte de nuestro tiempo a realizar una actividad física, 
    es decir, a hacer ejercicio moviendo las partes de nuestro cuerpo. 
    Cuando hacemos deporte nos divertimos y pasamos un buen rato. </p>
    <p> La motivación es lo que te pone en marcha, y el habito es lo que hace que sigas.
      Para tener éxito, en primer lugar debemos creer que podemos.
      Da siempre lo mejor de ti. Lo que siembres hoy dará su fruto manana.
      Acepta los retos para así poder sentir la euforia de la victoria.
      La clave para iniciar algo es dejar de hbalar y ponerse a realizar.
      Adentrate en nuestro universo Lifety y disfruta de todo tipo de contenidos. </p>

  </div>



  EOS;

  require __DIR__.'/includes/vistas/plantillas/plantilla.php';