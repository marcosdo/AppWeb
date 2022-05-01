<?php
namespace appweb\chat;

use appweb\Aplicacion;
use appweb\usuarios\Premium;

class  MostrarChatUsuario {
    function __construct() {}
    
    private function mostrarMensajes($Receptor,$Origen){
        $rts = "";
        $rts = $rts ."<textarea rows= '10' name = 'msg' readonly= 'readonly' class = 'chat'>";
		$array_msg = Chat::arrayMensajes($Receptor,$Origen);

        $data = "[" . $Receptor . " 🡺 " . $Origen . "]";
        for ($i=0; $i < sizeof($array_msg); $i++) { 
            if($array_msg[$i][4] == "E-U"){
                $data = $data . "\n". "🡸 [" . $array_msg[$i][3] . "] " .
                $array_msg[$i][1] . ": " . $array_msg[$i][2];
            }else{
                $data = $data . "\n". "🡺 [" . $array_msg[$i][3] . "] " .
                $array_msg[$i][1] . ": " . $array_msg[$i][2];
           }
        }
        $rts = $rts . $data;
		$rts = $rts . "</textarea>";
        return $rts;
    }
    public function mostrarChat(){
        $app = Aplicacion::getInstance();
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
}