<?php
namespace es\ucm\fdi\aw;

class FormularioLogros extends Formulario {
    public function __construct() {
        parent::__construct('formLogros', ['urlRedireccion' => 'EntrenadorPersonalEnt.php']);
        
    }
    function Usuarios($entNombre){
        $rts = "";
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM profesional WHERE id_profesional = '%d'",$entNombre); 
        $rs = $conn->query($query); 
        $fila = $rs->fetch_assoc();
        $cadena = explode(",",$fila["usuarios"]);
        foreach($cadena as $usuario){
            if($usuario != "")  $rts = $rts ."<option value='$usuario'>$usuario</option>";
        }
        $rs->free();
        return $rts;
    }
    function mostrarFormulario() {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $usuactual = $_SESSION["alias"];
        $id_usuario =  $_SESSION["id"];
       
        $SelectUsuarios = self::Usuarios($id_usuario);

        $alert ="";
        if(isset($_POST['buttonLogro'])) {
            $logroE = $_POST["logrosE"];
            $id = $_POST["idE"];

            $query = sprintf("SELECT * FROM usuario WHERE usuario = '%s'",$id);
            $rs = $conn->query($query);
            $fila = $rs->fetch_assoc();
            $idusuE = $fila["id_usuario"];
            $rs->free();

           /* $consulta = mysqli_query($BD,"SELECT * FROM usuario WHERE usuario = '$id'");
            $nombreusu =  mysqli_fetch_array($consulta);
            $idusuE = $nombreusu["id_usuario"];*/


            $query = sprintf("SELECT * FROM premium WHERE id_usuario = '%s'",$idusuE);
            $rs = $conn->query($query);
            $fila = $rs->fetch_assoc();
            $EnumLogros = $fila["logros"];
            $rs->free();
           /* $consulta = mysqli_query($BD,"SELECT * FROM premium WHERE id_usuario = '$idusuE'"); 
            $usu = mysqli_fetch_array($consulta);
            $EnumLogros = $usu["logros"];*/

            if(!preg_match("/{$logroE}/i",$EnumLogros)){
                $EnumLogros = $EnumLogros . "," . $logroE;
                $num = $fila["num_logros"];
                $num++;

                $query = sprintf("UPDATE premium SET num_logros = '%d', logros = '%s' WHERE id_usuario = '%s' ",$num,$EnumLogros,$idusuE);
                $rs = $conn->query($query);
                //mysqli_query($BD,"UPDATE premium SET num_logros = '$num', logros = '$EnumLogros' WHERE id_usuario = '$idusuE' ");
                $alert = "<span class ='text1'>Completado</span>";
            } 
            else $alert = "<span class='text2'>Ya tiene este logro</span>";
        
        }
        if(isset($_POST['quitarLogro'])) {
            $logroE = $_POST["logrosE"];
            $id = $_POST["idE"];

            $query = sprintf("SELECT * FROM usuario WHERE usuario = '%s'",$id);
            $rs = $conn->query($query);
            $fila = $rs->fetch_assoc();
            $idusuE = $fila["id_usuario"];
            $rs->free();
            /*$consulta = mysqli_query($BD,"SELECT * FROM usuario WHERE usuario = '$id'");
            $nombreusu =  mysqli_fetch_array($consulta);
            $idusuE = $nombreusu["id_usuario"];*/
            $query = sprintf("SELECT * FROM premium WHERE id_usuario = '%s'",$idusuE);
            $rs = $conn->query($query);
            $fila = $rs->fetch_assoc();
            $EnumLogros = $fila["logros"];
            $rs->free();
           /* $consulta = mysqli_query($BD,"SELECT * FROM premium WHERE id_usuario = '$idusuE'"); 
            $usu = mysqli_fetch_array($consulta);
            $EnumLogros = $usu["logros"];*/



            if(preg_match("/{$logroE}/i",$EnumLogros)){
                $EnumLogrosEliminado = str_replace($logroE ,'',$EnumLogros);
                $num = $fila["num_logros"];
                $num--;
                $query = sprintf("UPDATE premium SET num_logros = '%d', logros = '%s' WHERE id_usuario = '%s' ",$num,$EnumLogrosEliminado,$idusuE);
                $rs = $conn->query($query);
                //mysqli_query($BD,"UPDATE premium SET num_logros = '$num', logros = '$EnumLogrosEliminado' WHERE id_usuario = '$idusuE' ");
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
        <button type="submit" name="quitarLogro">Quitar Logro</button>
        <button type="submit" name="buttonLogro">Añadir Logro</button>
        </div>
        EOF;

        return $html;
    }
}
