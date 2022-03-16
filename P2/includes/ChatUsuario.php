<?php
namespace es\ucm\fdi\aw;

class  ChatUsuario {
    /// PUBLIC
    // Constructor
    function __construct() {

    }
    
    function dataChat($nombreUsu,$nombreEnt,$BD){
        $rts = "";
		$data = "[" . $nombreUsu . " 🡺 " . $nombreEnt . "]";
		$consulta = mysqli_query($BD,"SELECT * FROM chat WHERE (Origen = '$nombreUsu' AND Receptor = '$nombreEnt') OR (Origen = '$nombreEnt' AND Receptor = '$nombreUsu') ORDER BY Tiempo ASC ");
		while($chats = mysqli_fetch_array($consulta)){
			if($chats["Tipo"] == "E-U")$data = $data . "\n". "🡸 [" . $chats["Tiempo"] . "] " . $chats["Origen"] . ": " . $chats["Contenido"];
			else $data = $data . "\n". "🡺 [" . $chats["Tiempo"] . "] " . $chats["Origen"] . ": " . $chats["Contenido"];
					
		}
		$rts = $rts ."<textarea rows= '10' name = 'msg' readonly= 'readonly' class = 'chat'>";
		$rts = $rts . $data;
		$rts = $rts . "</textarea>";
		return $rts;
    }
    function mostrarChat(){
        $BD = Aplicacion::getInstance()->getConexionBd();
        //$usuactual = $_SESSION["id"];
        $usuactual = "Usuario1";


        $consulta = mysqli_query($BD,"SELECT * FROM premium WHERE id_usuario = '$usuactual'"); 
        $usu =  mysqli_fetch_array($consulta);
        $usuEntrenador = $usu["id_profesional"];
       
        $dataChat = ChatUsuario::dataChat($usuactual,$usuEntrenador,$BD);

        if(isset($_POST['submitmsg'])) {
            $fecha = date_create()->format('Y-m-d H:i:s');
            mysqli_query($BD,"INSERT INTO chat (Origen,Receptor,Contenido,Tiempo,Tipo) VALUES ('$usuactual ','$usuEntrenador','$_POST[usermsg]','$fecha','U-E') ");
        }


        $contenidoPrincipal = <<<EOF
        <div id="wrapper">
        <h1><span class ="text">C H A T &nbsp E N T R E N A D O R</span></h1>
        <span class="welcome">&nbsp &nbspBienvenido,<b> $usuactual</b>
        &nbsp&nbsp Tu entrenador es,<b>$usuEntrenador</b></span>
        <div id="chatbox"></div>
        $dataChat 
        <input name="usermsg" type="text" id="usermsg" size="63" />
        <input type="submit"  name="submitmsg" value="send"/>
        </div>  
        EOF;
        return $contenidoPrincipal;
    }
}