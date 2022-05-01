<?php
namespace appweb\chat;

use appweb\Aplicacion;
use appweb\usuarios\Profesional;

class  MostrarChatEntrenador {

    function __construct() {}

    public static function Usuarios($entNombre){
        $rts = "";
        $array = Profesional::getUsuario($entNombre);
        for ($i=0; $i < sizeof($array); $i++) { 
            $rts = $rts ."<option value='$array[$i]'>$array[$i]</option>";
        } 
        return $rts;
    }

    private function mostrarMensajes($Receptor,$Origen,$actualizado){
        $mensajes = "";
        $mensajes = $mensajes . "<textarea rows= '10' name = 'msg' readonly= 'readonly' class = 'chat'>";
        if($actualizado){
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
            $mensajes = $mensajes . $data;
        }else{
            $mensajes = $mensajes . "Debes Actualizar Chat para ver la información";
        }
        $mensajes = $mensajes ."</textarea>";
        return $mensajes;
    }

    public function mostrarChat(){
        $app = Aplicacion::getInstance();
        $usuactual = $app->nombreUsuario();
        $id_usuario = $app->idUsuario();
       
        $mensajes = "";

        if(isset($_POST['idE2'])) $mensajes = self::mostrarMensajes($_POST["idE2"] ,$usuactual,true);
        else $mensajes = self::mostrarMensajes("",$usuactual,false);

        $SelectUsuarios = self::Usuarios($usuactual);
        $form1 = new FormularioEnviarMensajeEnt();
        $html1 = $form1->gestiona();

        $contenidoPrincipal = <<<EOF
        <h1>CHAT CON USUARIO</h1>
        <h3>Elige usuario para visualizar su chat:</h3>
        <select name = 'idE2' id = 'idE2' type = 'text'>$SelectUsuarios</select>
        <button class = "ButtonActua"name='actua1' type='submit' id='actua1' >Actualizar Chat</button>
        $mensajes
        $html1
        EOF;
        
        return $contenidoPrincipal;
    }
}
