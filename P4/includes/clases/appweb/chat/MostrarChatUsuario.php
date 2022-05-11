<?php
namespace appweb\chat;

use appweb\Aplicacion;
use appweb\usuarios\Premium;

class  MostrarChatUsuario {
    function __construct() {}
    
    private function mostrarMensajes($Receptor,$Origen){
		$array_msg = Chat::arrayMensajes($Receptor,$Origen);

        $chat = "<div id=chat> <div class='entrenador'> Entrenador 🡺 $Origen</div><div id=scroll>";
        for ($i=0; $i < sizeof($array_msg); $i++) { 
            if($array_msg[$i][4] == "E-U"){
                $chat = $chat. "<div id=entrenador><div class=texto>". $array_msg[$i][2]."</div><div class=fecha>".$array_msg[$i][3]."</div></div>";
            }else{
                $chat = $chat. "<div id=usuario><div class=texto>". $array_msg[$i][2]."</div><div class=fecha>".$array_msg[$i][3]."</div></div>";
           }
        }
        $chat .= "</div></div>";

        return $chat;
    }
    public function mostrarChat(){
        $app = Aplicacion::getInstance();
        if ($app->usuarioLogueado() == true){
            $usuactual = $app->nombreUsuario();
            $id_usuario = $app->idUsuario();
            $nombreEnt = Premium::getNombreEntrenador($id_usuario);
    
            $form1 = new FormularioEnviarMensajeUsu();
            $html1 = $form1->gestiona();
    
            $mensajes = self::mostrarMensajes($usuactual,$nombreEnt);
    
            $contenidoPrincipal = <<<EOF
            <h1>CHAT ENTRENADOR</h1>
            $mensajes 
            $html1
            EOF;
            return $contenidoPrincipal;
        }
        else{
            header('Location: login.php');
            die();
        }
        
    }
}