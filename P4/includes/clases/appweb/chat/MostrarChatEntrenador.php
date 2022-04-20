<?php
namespace appweb\chat;

use appweb\usuarios\Profesional;

class  MostrarChatEntrenador {

    function __construct() {}

    private function Usuarios($entNombre){
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
            $mensajes = $mensajes . Chat::dataChat($Receptor,$Origen);
        }else{
            $mensajes = $mensajes . "Debes Actualizar Chat para ver la información";
        }
        $mensajes = $mensajes ."</textarea>";
        return $mensajes;
    }

    public function mostrarChat(){
        $usuactual = $_SESSION["alias"];
        $id_usuario =  $_SESSION["id"];
       
        $mensajes = "";
        if(isset($_POST['idE2'])) $mensajes = self::mostrarMensajes($_POST["idE2"] ,$usuactual,true);
        else $mensajes = self::mostrarMensajes("",$usuactual,false);

        $SelectUsuarios = self::Usuarios($usuactual);
        if(isset($_POST['idE3'])) {
            if(isset($_POST['submitmsg'])) Chat::enviarMsg($_POST["idE3"],$usuactual,$_POST["usermsg"],"E-U");
        }

        $contenidoPrincipal = <<<EOF
    
        <h1>CHAT CON USUARIO</h1>
        <h3>Elige usuario para visualizar su chat:</h3>
        <select name = 'idE2' id = 'idE2' type = 'text'>$SelectUsuarios</select>
        <input class = "ButtonActua"name='actua' type='submit' id='actua' value='Actualizar Chat'/>
        $mensajes
        <h3>Elige usuario al que escribir un mensaje</h3>
        <select name = 'idE3' id = 'idE3' type = 'text'>
        $SelectUsuarios
        </select>
        <input name="usermsg" type="text" id="usermsg" placeholder="Escriba su mensaje..." size="63"/>
        <input class = "ButtonEnviar" name="submitmsg" type="submit"  id="submitmsg" value="Send" />
        EOF;
        
        return $contenidoPrincipal;
    }
}
