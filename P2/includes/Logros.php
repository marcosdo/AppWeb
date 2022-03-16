<?php
namespace es\ucm\fdi\aw;

class  Logros {
    /// PUBLIC
    // Constructor
    function __construct() {
    }
    
    function LogrosImg($EnumLogros,$BD){
        $rts = "";
		$logro = "";
		
		for($i = 0; $i < strlen($EnumLogros); $i++){
			if($EnumLogros[$i] == ","){
				$logro = $logro . ".png";
				$rts = $rts . "<img src='img/logros/$logro' alt='' width='70' height='70'>";
				$logro = "";
			}
			else $logro = $logro . $EnumLogros[$i];
			if($i+1 == strlen($EnumLogros)){
				$logro = $logro . ".png";
				$rts = $rts . "<img src='img/logros/$logro' alt='' width='70' height='70'>";
			}
		}
		return $rts;
    }
    function mostrarLogros(){
        $BD = Aplicacion::getInstance()->getConexionBd();
        //$usuactual = $_SESSION["id"];
        $usuactual = "Usuario1";
         
        $consulta = mysqli_query($BD,"SELECT * FROM premium WHERE id_usuario = '$usuactual'"); 
        $usu =  mysqli_fetch_array($consulta);
        $usuLogros = $usu["num_logros"];
	    $EnumLogros = $usu["logros"];

        
        $imaginesLogros = Logros::LogrosImg($EnumLogros,$BD);
        $contenidoPrincipal = <<<EOF
        <h1><span class = 'text'>T U S &nbsp L O G R O S</span></h1>
        <div id = 'selectA'>
        <h3><span class = 'text'>Número de logros : &nbsp<b>$usuactual</b></span></h3>
        </div>
        <div id = 'selectA'>
        $imaginesLogros
        </div>
        EOF;
        return $contenidoPrincipal;
    }
}