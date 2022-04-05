<?php
namespace es\ucm\fdi\aw;

class  ChatUsuario {
    /// PUBLIC
    // Constructor
    function __construct() {

    }
    
    function dataChat($nombreUsu,$nombreEnt){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $rts = "";
		$data = "[" . $nombreUsu . " 🡺 " . $nombreEnt . "]";
		
        $query = sprintf("SELECT * FROM chat WHERE (Origen = '%s' AND Receptor = '%s') OR (Origen = '%s' AND Receptor = '%s') ORDER BY Tiempo ASC ",$nombreUsu,$nombreEnt,$nombreEnt,$nombreUsu);
        $rs1 = $conn->query($query); 
        while($chats = $rs1->fetch_assoc()){
			if($chats["Tipo"] == "E-U")$data = $data . "\n". "🡸 [" . $chats["Tiempo"] . "] " . $chats["Origen"] . ": " . $chats["Contenido"];
			else $data = $data . "\n". "🡺 [" . $chats["Tiempo"] . "] " . $chats["Origen"] . ": " . $chats["Contenido"];
		}
      
		$rts = $rts ."<textarea rows= '10' name = 'msg' readonly= 'readonly' class = 'chat'>";
		$rts = $rts . $data;
		$rts = $rts . "</textarea>";
        $rs1->free();
		return $rts;
    }
    function mostrarChat(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $usuactual = $_SESSION["alias"];
        $id_usuario =  $_SESSION["id"];

        $query = sprintf("SELECT * FROM premium WHERE id_usuario = '%d'", $id_usuario);
        $rs = $conn->query($query); 
        $fila = $rs->fetch_assoc();
        $usuEntrenador = $fila["id_profesional"];
        $rs->free();
       

        $query = sprintf("SELECT * FROM profesional WHERE id_profesional = '%d'", $usuEntrenador);
        $rs = $conn->query($query); 
        $fila = $rs->fetch_assoc();
        $nombreEnt = $fila["nutri"];
        $rs->free();
        
        $dataChat = self::dataChat($usuactual,$nombreEnt);

        if(isset($_POST['submitmsg'])) {
            $fecha = date_create()->format('Y-m-d H:i:s');
            $query = sprintf("INSERT INTO chat (Origen,Receptor,Contenido,Tiempo,Tipo) VALUES ('%s','%s','%s','%s','%s')",$usuactual,$nombreEnt,$_POST["usermsg"],$fecha,'U-E'); 
            $rs = $conn->query($query);
        }

        $contenidoPrincipal = <<<EOF
        <div id="wrapper">
        <h1><span class ="text">C H A T &nbsp E N T R E N A D O R</span></h1>
        <span class="welcome">&nbsp &nbspBienvenido,<b> $usuactual</b>
        &nbsp&nbsp Tu entrenador es,<b>$nombreEnt</b></span>
        <input class = "ButtonActua"name='actua' type='submit' id='actua' value='Actualizar Chat'/>
        <div id="chatbox"></div>
        $dataChat 
        <input name="usermsg" type="text" id="usermsg" size="63" />
        <input class = "ButtonEnviar"type="submit"  name="submitmsg" value="send"/>
        </div>  
        EOF;
        return $contenidoPrincipal;
    }
}