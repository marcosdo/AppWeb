<?php
namespace es\ucm\fdi\aw;

class  ChatEntrenador {
    /// PUBLIC
    // Constructor
    function __construct() {
        
    }
    
    function dataChat($nombreUsu,$entNombre){
        $rts = "";
        $data = "";
        $data =  "[". $data . $entNombre . " 🡺 " .$nombreUsu . "]";
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM chat WHERE (Origen = '%s' AND Receptor = '%s') OR (Origen = '%s' AND Receptor = '%s') ORDER BY Tiempo ASC ",$entNombre,$nombreUsu,$nombreUsu,$entNombre); 
        $rs = $conn->query($query); 
        while($chats = $rs->fetch_assoc()){
            if($chats["Tipo"] == "E-U")$data = $data . "\n". "🡺 (" . $chats["Tiempo"] . ") " . $chats["Origen"] . ": " . $chats["Contenido"];
            else $data = $data . "\n". "🡸 [" . $chats["Tiempo"] . "] " . $chats["Origen"] . ": " . $chats["Contenido"];
        }
        $rts = $rts . "<textarea rows= '10' name = 'msg' readonly= 'readonly' class = 'chat'>";
        $rts = $rts . $data;
        $rts = $rts ."</textarea>";
        $rs->free();
        return $rts;
    }

    function Usuarios($entNombre){
        $rts = "";
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM entrena WHERE nutri = '%s'",$entNombre); 
        $rs = $conn->query($query); 
        while($fila = $rs->fetch_assoc()){
            $rts = $rts ."<option value='$fila[usuario]'>$fila[usuario]</option>";
        }
        $rs->free();
        return $rts;
    }

    function mostrarChat(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $usuactual = $_SESSION["alias"];
        $id_usuario =  $_SESSION["id"];
       

        $dataChat = "";

        if(isset($_POST['idE2'])) {

            $query = sprintf("SELECT * FROM usuario WHERE usuario = '%s'",$_POST["idE2"]); 
            $rs = $conn->query($query); 
            $fila = $rs->fetch_assoc();
            $NICKusu = $fila["usuario"];
            $rs->free();
       
            $dataChat = self::dataChat($NICKusu, $usuactual);
        }
        else{
            $dataChat = $dataChat . "<textarea rows= '10' name = 'msg' readonly= 'readonly' class = 'chat'>";
            $dataChat = $dataChat . "Debes Actualizar Chat para ver la información";
            $dataChat = $dataChat ."</textarea>";
        } 
        $SelectUsuarios = self::Usuarios($usuactual);

        if(isset($_POST['idE3'])) {
            if(isset($_POST['submitmsg'])) {
                $query = sprintf("SELECT * FROM usuario WHERE usuario = '%s'",$_POST["idE3"]); 
                $rs = $conn->query($query); 
                $fila = $rs->fetch_assoc();
                $NICKusu = $fila["usuario"];
                $rs->free();
    
                $fecha = date_create()->format('Y-m-d H:i:s');
                $query = sprintf("INSERT INTO chat (Origen,Receptor,Contenido,Tiempo,Tipo) VALUES ('%s','%s','%s','%s','%s')",$usuactual,$NICKusu, $_POST["usermsg"],$fecha,'E-U'); 
                $rs = $conn->query($query);
            }
        }

        $contenidoPrincipal = <<<EOF
        <div id="wrapper"><div id="menu">
        <h1><span class = 'text'>C H A T &nbsp C O N &nbsp U S U A R I O</span></h1>
        <span class="welcome" >&nbsp&nbsp Bienvenido, $usuactual</span>
        <span class = 'text'>Elige usuario:</span>
        <select name = 'idE2' id = 'idE2' type = 'text'>$SelectUsuarios</select>
        <input class = "ButtonActua"name='actua' type='submit' id='actua' value='Actualizar Chat'/>
        </div>
        <div id="chatbox"></div>$dataChat
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
