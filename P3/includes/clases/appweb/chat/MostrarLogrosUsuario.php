<?php
namespace appweb\chat;

class  MostrarLogrosUsuario {
    function __construct() {}
    
    private function LogrosImg($EnumLogros){
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
    public function mostrarLogrosUsu(){
        $usuactual = $_SESSION["alias"];
        $id_usuario =  $_SESSION["id"];
      
        $numLogros = Logros::getNumLogros($id_usuario);
	    $EnumLogros = Logros::getLogros($id_usuario);
        
        $imaginesLogros = self::LogrosImg($EnumLogros);
        $contenidoPrincipal = <<<EOF
        <div id = 'selectA'>
        <h3>Número de logros $numLogros</h3>
        </div>
        <div id = 'selectA'>
        $imaginesLogros
        </div>
        EOF;
        return $contenidoPrincipal;
    }
}