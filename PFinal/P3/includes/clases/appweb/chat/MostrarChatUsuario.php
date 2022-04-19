<?php
namespace appweb\chat;

use appweb\chat\Chat;
use appweb\usuarios\Premium;

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
        <h1>CHAT ENTRENADOR</h1>
        $mensajes 
        <input name="usermsg" type="text" id="usermsg" size="63"  placeholder="Escriba su mensaje..."/>
        <input class = "ButtonEnviar"type="submit"  name="submitmsg" value="send"/>
        <input class = "ButtonActua"name='actua' type='submit' id='actua' value='Actualizar Chat'/>
        EOF;
        return $contenidoPrincipal;
    }
}