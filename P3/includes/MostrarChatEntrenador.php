<?php
namespace es\ucm\fdi\aw;

class  MostrarChatEntrenador {

    function __construct() {}

    function Usuarios($entNombre){
        $rts = "";
        $array = Profesional::getUsuario($entNombre);
        for ($i=0; $i < sizeof($array); $i++) { 
            $rts = $rts ."<option value='$array[$i]'>$array[$i]</option>";
        } 
        return $rts;
    }

    function mostrarMensajes($Receptor,$Origen,$actualizado){
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

    function mostrarChat(){
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
        <div id="wrapper"><div id="menu">
        <h1><span class = 'text'>C H A T &nbsp C O N &nbsp U S U A R I O</span></h1>
        <span class="welcome" >&nbsp&nbsp Bienvenido, $usuactual</span>
        <span class = 'text'>Elige usuario:</span>
        <select name = 'idE2' id = 'idE2' type = 'text'>$SelectUsuarios</select>
        <input class = "ButtonActua"name='actua' type='submit' id='actua' value='Actualizar Chat'/>
        </div>
        <div id="chatbox"></div>$mensajes
        <input name="usermsg" type="text" id="usermsg" size="63" />
        <span class = 'text'>D: </span>
        <select name = 'idE3' id = 'idE3' type = 'text'>
        $SelectUsuarios
        </select>
        <input class = "ButtonEnviar" name="submitmsg" type="submit"  id="submitmsg" value="Send" />
        </div>
        EOF;
        
        return $contenidoPrincipal;
    }
}
