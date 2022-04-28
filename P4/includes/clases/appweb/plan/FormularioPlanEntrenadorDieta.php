<?php
namespace appweb\plan;

use appweb\Formulario;
use appweb\Aplicacion;

class FormularioPlanEntrenadorDieta extends Formulario {
    public function __construct() {
        parent::__construct('formEntrenadorDietas', ['urlRedireccion' => 'planeditardieta.php']);
    }
    
    private function Usuarios($entNombre){
        $rts = "";
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM entrena WHERE nutri = '%s'",$entNombre); 
        $rs = $conn->query($query); 
        while($fila = $rs->fetch_assoc()){
            $queryid = sprintf("SELECT * FROM personas WHERE nick = '%s'",$fila['usuario']);            
            $rsid = $conn->query($queryid);
            $filaid = $rsid->fetch_assoc();
            if($filaid != null){
                $id = $filaid['id_usuario'];
                $query2 = sprintf("SELECT * FROM usuario WHERE id_usuario = '%s'",$id);            
                $rs2 = $conn->query($query2); 
                $filausuario = $rs2->fetch_assoc();
                $query3 = sprintf("SELECT * FROM dieta WHERE id_usuario = '%s'",$filausuario['id_usuario']);          
                $rs3 = $conn->query($query3); 
                $row_cnt = $rs3->num_rows;
                if($row_cnt >0) $rts = $rts ."<option value='$fila[usuario]'>$fila[usuario]</option>";
            }
        }

       if($rts != "") $rs->free();
        
       return $rts;
    }

    protected function generaCamposFormulario(&$datos) {
        $alias = $datos['alias'] ?? '';

        $app = Aplicacion::getInstance();

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['alias'], $this->errores, 'span', array('class' => 'error'));
    
        $SelectUsuarios = self::Usuarios($app->idUsuario());
        $boton ="";
        if($SelectUsuarios == "") $Select = "<p>No hay usuarios disponibles.</p>";
        else {
            $Select = "<p>Selecciona el usuario<p><div><select name = 'alias' id = 'alias' type = 'text'>";
            $Select .= $SelectUsuarios;
            $Select .= "</select>";
            $boton = "<button type='submit' name='enviar'>Editar dieta </button>";
        }
        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
                        $Select
                    {$erroresCampos['alias']}
                        $boton
           
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        $this->errores = [];
        htmlspecialchars(trim(strip_tags($_POST["alias"])));
        $alias      = trim($datos["alias"] ?? '');

        if (count($this->errores) === 0) {
            $conn = Aplicacion::getInstance()->getConexionBd();
            
            $queryr = sprintf("UPDATE entrena SET entrena.editadieta = '%d' WHERE entrena.usuario = '%s'",1, $alias); 
            $conn->query($queryr);
            
        }
    }
}
