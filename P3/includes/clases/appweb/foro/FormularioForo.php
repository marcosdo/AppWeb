<?php
namespace appweb\foro;

use appweb\Formulario;
use appweb\Aplicacion;
use appweb\foro\Mensaje;

class FormularioForo extends Formulario {
    public function __construct() { 
        parent::__construct('formForo', ['urlRedireccion' => 'foros.php']);
    }

    //mirar porque alomejor no deberia hacerse aqui al hacer una conexion a BD y deberia hacerse desde la clase foro :)
    private function seleCategorias(){
        $rts = "";
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SHOW COLUMNS FROM foro WHERE Field = '%s'",
            "categoria"
        );
        $rs = $conn->query($query);
        $fila = $rs->fetch_assoc();
        $type = $fila['Type'];
        $matches = array();
        $enum = array();
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        $rts = $rts . " <select name='categoria' id='categoria'>";
        for($i = 0; $i < sizeof($enum); $i++){
            $rts = $rts . " <option value = '{$enum[$i]}'> {$enum[$i]} </option>";
        }
        $rts = $rts . " </select>";
        return $rts;
    }


    protected function generaCamposFormulario(&$datos) {
        $tema = $datos['tema'] ?? '';
        $contenido = $datos['contenido'] ?? '';
        $categoria = $datos['categoria'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['tema', 'contenido', 'categoria'], $this->errores, 'span', array('class' => 'error'));
        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $categoria = self::seleCategorias(); //en vez de self poner foro

        $html = <<<EOF
        $htmlErroresGlobales
        <h3>¿Quieres crear un nuevo tema?</h3>
        <input id="tema" type="text" name="tema" value="$tema" placeholder="tema" />
        {$erroresCampos['tema']}
        <input id="contenido" type="text" name="contenido" value="$contenido" placeholder="contenido" />
        {$erroresCampos['contenido']}
        $categoria
        {$erroresCampos['categoria']}
        <button type="submit" name="enviar">Crear este foro</button>
        EOF;
        return $html;
    
    
    }

    protected function procesaFormulario(&$datos) { 
        $this->errores = [];

        $tema = $datos['tema'] ?? '';
        $contenido = $datos['contenido'] ?? '';
        $categoria = $datos['categoria'] ?? '';

        $tema = filter_var($tema, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$tema || empty($tema))
            $this->errores['tema'] = '¿Cuál es el tema de la discusión?';

        $contenido = filter_var($contenido, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$contenido || empty($contenido))
            $this->errores['contenido'] = 'Es necesario rellenar el contenido del foro.';

        $categoria = filter_var($categoria, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$categoria || empty($categoria))
            $this->errores['categoria'] = 'Has adelturado el desplegable pillín.';

        if (count($this->errores) === 0) {
            try {
                $foro = Foro::crearForo($_SESSION['alias'], $_SESSION['id'], date_create()->format('Y-m-d H:i:s'), $tema, $contenido, $categoria);
                Mensaje::creaMensaje($_SESSION['id'], $foro->getID(), $contenido);
                /* POP UP */
                $app = Aplicacion::getInstance();
                $mensajes = ['Se ha creado el foro'];
                $app->putAtributoPeticion('mensajes', $mensajes);
            } catch (\Exception $e) {
                $this->errores[] = 'Este tema ya existe.';
           }
        }
    }
}