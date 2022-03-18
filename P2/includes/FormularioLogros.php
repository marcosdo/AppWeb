<?php
namespace es\ucm\fdi\aw;

class FormularioLogros extends Formulario {
    public function __construct() {
        parent::__construct('formLogros', ['urlRedireccion' => 'EntrenadorPersonalEnt.php']);
        
    }
    function Usuarios($entNombre, $BD){
        $rts = "";
        $consulta = mysqli_query($BD,"SELECT * FROM profesional WHERE id_profesional = '$entNombre'");
        $BDLogros =  mysqli_fetch_array($consulta);
        $cadena = explode(",",$BDLogros["usuarios"]);
        foreach($cadena as $usuario){
            if($usuario != "")  $rts = $rts ."<option value='$usuario'>$usuario</option>";
        }
        return $rts;
    }
    function mostrarFormulario() {
        $BD = Aplicacion::getInstance()->getConexionBd();
        $usuactual = $_SESSION["alias"];
        $id_usuario =  $_SESSION["id"];
       //$usuactual = "Entrenador1";
        $SelectUsuarios = self::Usuarios($id_usuario,$BD);

        $alert ="";
        if(isset($_POST['buttonLogro'])) {
            $logroE = $_POST["logrosE"];
            $id = $_POST["idE"];

            $consulta = mysqli_query($BD,"SELECT * FROM usuario WHERE usuario = '$id'");
            $nombreusu =  mysqli_fetch_array($consulta);
            $idusuE = $nombreusu["id_usuario"];

            $consulta = mysqli_query($BD,"SELECT * FROM premium WHERE id_usuario = '$idusuE'"); 
            $usu = mysqli_fetch_array($consulta);
            $EnumLogros = $usu["logros"];
            if(!preg_match("/{$logroE}/i",$EnumLogros)){
                $EnumLogros = $EnumLogros . "," . $logroE;
                $num = $usu["num_logros"];
                $num++;
                mysqli_query($BD,"UPDATE premium SET num_logros = '$num', logros = '$EnumLogros' WHERE id_usuario = '$idusuE' ");
                $alert = "<span class ='text1'>Completado</span>";
            } 
            else $alert = "<span class='text2'>Ya tiene este logro</span>";
        
        }
        if(isset($_POST['quitarLogro'])) {
            $logroE = $_POST["logrosE"];
            $id = $_POST["idE"];
            $consulta = mysqli_query($BD,"SELECT * FROM usuario WHERE usuario = '$id'");
            $nombreusu =  mysqli_fetch_array($consulta);
            $idusuE = $nombreusu["id_usuario"];

            $consulta = mysqli_query($BD,"SELECT * FROM premium WHERE id_usuario = '$idusuE'"); 
            $usu = mysqli_fetch_array($consulta);
            $EnumLogros = $usu["logros"];
            if(preg_match("/{$logroE}/i",$EnumLogros)){
                $EnumLogrosEliminado = str_replace($logroE ,'',$EnumLogros);
                $num = $usu["num_logros"];
                $num--;
                mysqli_query($BD,"UPDATE premium SET num_logros = '$num', logros = '$EnumLogrosEliminado' WHERE id_usuario = '$idusuE' ");
                $alert = "<span class ='text1'>Completado</span>";
            }
            else $alert = "<span class='text2'>No posee este logro</span>";
        }
        $html = <<<EOF
        <h1><span class = 'text'>L O G R O S</span></h1>
        <div id = 'selectA'>
        <h3><span class = 'textD'>Seleccione el Logro :</span></h3>
        <h3><span class = 'textI'>Seleccione al Usuario :</span></h3>
        </div>
        <div id = 'select'>
        <select name = 'logrosE' id = 'logrosE' type = 'text' class = 'selectA'>
        <option value='5logros'>Completar 5 Logros</option>
        <option value='AccesoTodos'>Acceso a todas las areas</option>
        <option value='ComenzarChat'>Comenzar chat</option>
        <option value='Completa1Plan'>Completar 1 plan</option>
        <option value='Completa5Plan'>Completar 5 plan</option>
        <option value='ContrataNutri'>Contratar un Nutricionista</option>
        <option value='Foro'>Entrar en el foro</option>
        <option value='Permanencia'>Sesión 5 dias seguidos</option>
        <option value='Permanencia1m'>Sesión 1 mes seguidos</option>
        </select>
        <select name = 'idE' id = 'idE' type = 'text' class = 'selectB'>
        $SelectUsuarios
        </select>
        </div>
        <div id = 'select'><h3>
        $alert
        </h3></div>
        <div id = 'select'>
        <input type='submit' class = 'ButtonD' name='quitarLogro' value='Quitar Logro'/>
        <input type='submit' class = 'ButtonI' name='buttonLogro' value='Añadir Logro'/>
        </div>
        EOF;

        return $html;
    }
}
/*
<h1><span class = 'text'>L O G R O S</span></h1>
	<div id = 'selectA'>
		<h3><span class = 'textD'>Seleccione el Logro :</span></h3>
		<h3><span class = 'textI' >Seleccione al Usuario :</span></h3>
	</div>
	<div id = 'select' >
		<select name = 'logrosE' id = 'logrosE' type = 'text' class = 'selectA'>
			<option value='5logros'>Completar 5 Logros</option>
			<option value='AccesoTodos'>Acceso a todas las areas</option>
			<option value='ComenzarChat'>Comenzar chat</option>
			<option value='Completa1Plan'>Completar 1 plan</option>
			<option value='Completa5Plan'>Completar 5 plan</option>
			<option value='ContrataNutri'>Contratar un Nutricionista</option>
			<option value='Foro'>Entrar en el foro</option>
			<option value='Permanencia'>Sesión 5 dias seguidos</option>
			<option value='Permanencia1m'>Sesión 1 mes seguidos</option>
		</select>
		<select name = 'idE' id = 'idE' type = 'text' class = 'selectB'>
			$SelectUsuarios
		</select>
	</div>
	<div id = 'select'><h3>
		$alert
	</h3></div>
	<div id = 'select'>
		<input type='submit' class = 'ButtonD' name='quitarLogro' value='Quitar Logro'/>
		<input type='submit' class = 'ButtonI' name='buttonLogro' value='Añadir Logro'/>
	</div>


*/ 