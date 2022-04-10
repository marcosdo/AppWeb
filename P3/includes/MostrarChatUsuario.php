<?php
namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Chat;


class  MostrarChatUsuario {
    function __construct() {}
    
    private function mostrarMensajes($Receptor,$Origen){
        $rts = "";
        $rts = $rts ."<textarea rows= '10' name = 'msg' readonly= 'readonly' class = 'chat'>";
		$rts = $rts . Chat::dataChat($Receptor,$Origen);
		$rts = $rts . "</textarea>";
        return $rts;
    }
    public function mostrarChat(){
        $usuactual = $_SESSION["alias"];
        $id_usuario =  $_SESSION["id"];
        $nombreEnt = Premium::getNombreEntrenador($id_usuario);

        $mensajes = self::mostrarMensajes($usuactual,$nombreEnt);
        if(isset($_POST['submitmsg'])) Chat::enviarMsg($nombreEnt,$usuactual,$_POST["usermsg"],"U-E");

        $contenidoPrincipal = <<<EOF
        <div id="wrapper">
        <h1><span class ="text">C H A T &nbsp E N T R E N A D O R</span></h1>
        <span class="welcome">&nbsp &nbspBienvenido,<b> $usuactual</b>
        &nbsp&nbsp Tu entrenador es,<b>$nombreEnt</b></span>
        <input class = "ButtonActua"name='actua' type='submit' id='actua' value='Actualizar Chat'/>
        <div id="chatbox"></div>
        $mensajes 
        <input name="usermsg" type="text" id="usermsg" size="63" />
        <input class = "ButtonEnviar"type="submit"  name="submitmsg" value="send"/>
        </div>  
        EOF;
        return $contenidoPrincipal;
    }
}