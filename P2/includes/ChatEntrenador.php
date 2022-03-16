<?php
namespace es\ucm\fdi\aw;

class  ChatEntrenador {
    /// PUBLIC
    // Constructor
    function __construct() {
        
    }
    
    function dataChat($nombreUsu,$entNombre,$BD){
        $rts = "";
        $data = "";
        $data =  "[". $data . $entNombre . " 🡺 " .$nombreUsu . "]";
        $consulta = mysqli_query($BD,"SELECT * FROM chat WHERE (Origen = '$entNombre' AND Receptor = '$nombreUsu') OR (Origen = '$nombreUsu' AND Receptor = '$entNombre') ORDER BY Tiempo ASC ");
        while($chats = mysqli_fetch_array($consulta)){
            if($chats["Tipo"] == "E-U")$data = $data . "\n". "🡺 (" . $chats["Tiempo"] . ") " . $chats["Origen"] . ": " . $chats["Contenido"];
            else $data = $data . "\n". "🡸 [" . $chats["Tiempo"] . "] " . $chats["Origen"] . ": " . $chats["Contenido"];
        }
        $rts = $rts . "<textarea rows= '10' name = 'msg' readonly= 'readonly' class = 'chat'>";
        $rts = $rts . $data;
        $rts = $rts ."</textarea>";
        return $rts;
    }

    function Usuarios($entNombre, $BD){
        $rts = "";
        $consulta = mysqli_query($BD,"SELECT * FROM profesional WHERE id_profesional = '$entNombre'");
        $BDLogros =  mysqli_fetch_array($consulta);
        $cadena = explode(",",$BDLogros["usuarios"]);
        foreach($cadena as $usuario){
            $rts = $rts ."<option value='$usuario'>$usuario</option>";
        }
        return $rts;
    }

    function mostrarChat(){
        $BD = Aplicacion::getInstance()->getConexionBd();
        //$usuactual = $_SESSION["id"];
        $usuactual = "Entrenador1";

        $dataChat = "";

        if(isset($_POST['idE2'])) {
            $dataChat = ChatEntrenador::dataChat($_POST['idE2'], $usuactual,$BD);
        }
        else{
            $dataChat = $dataChat . "<textarea rows= '10' name = 'msg' readonly= 'readonly' class = 'chat'>";
            $dataChat = $dataChat . "Debes Actualizar Chat para ver la información";
            $dataChat = $dataChat ."</textarea>";
        } 
        $SelectUsuarios = ChatEntrenador::Usuarios($usuactual, $BD);

        if(isset($_POST['idE3'])) {
            if(isset($_POST['submitmsg'])) {
                $fecha = date_create()->format('Y-m-d H:i:s');
                mysqli_query($BD,"INSERT INTO chat (Origen,Receptor,Contenido,Tiempo,Tipo) VALUES ('$usuactual','$_POST[idE3]','$_POST[usermsg]','$fecha','E-U') ");
            }
        }

        $contenidoPrincipal = <<<EOF
        <div id="wrapper"><div id="menu">
        <h1><span class = 'text'>C H A T &nbsp C O N &nbsp U S U A R I O</span></h1>
        <span class="welcome" >&nbsp&nbsp Welcome, $usuactual</span>
        <span class = 'text'>Elige usuario:</span>
        <select name = 'idE2' id = 'idE2' type = 'text'>$SelectUsuarios</select>
        <input name='actua' type='submit' id='actua' value='Actualizar Chat'/>
        </div>
        <div id="chatbox"></div>$dataChat
        <input name="usermsg" type="text" id="usermsg" size="63" />
        <span class = 'text'>D: </span>
        <select name = 'idE3' id = 'idE3' type = 'text'>
        $SelectUsuarios
        </select>
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
        </div>
        EOF;
        
        return $contenidoPrincipal;
    }
}
