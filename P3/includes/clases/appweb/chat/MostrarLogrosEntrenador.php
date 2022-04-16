<?php
namespace appweb\chat;

use appweb\usuarios\Profesional;

class MostrarLogrosEntrenador {
    public function __construct() {}

    private function Usuarios($entNombre){
        $rts = "";
        $array = Profesional::getUsuario($entNombre);
        for ($i=0; $i < sizeof($array); $i++) { 
            $rts = $rts ."<option value='$array[$i]'>$array[$i]</option>";
        } 
        return $rts;
    }

    public function mostrarLogrosEnt() {
        $usuactual = $_SESSION["alias"];
        $id_usuario =  $_SESSION["id"];
       
        $SelectUsuarios = self::Usuarios($usuactual);
        $alert ="";
        if(isset($_POST['buttonLogro'])) {
            if(Logros::addLogro($_POST["idE"],$_POST["logrosE"])) $alert = "<span class ='text1'>Completado</span>";
            else $alert = "<span class='text2'>Ya tiene este logro</span>";
        }
        if(isset($_POST['quitarLogro'])) {
            if(Logros::deleteLogro($_POST["idE"],$_POST["logrosE"])) $alert = "<span class ='text1'>Completado</span>";
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
