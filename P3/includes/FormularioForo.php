<?php
namespace es\ucm\fdi\aw;

class FormularioForo extends Formulario {
    public function __construct() {
        parent::__construct('formForo', ['urlRedireccion' => 'foroaux.php']);
    }

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
        $categorias = self::seleCategorias();

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset id ="formforo"> 
            <legend id="form-foro">Crear Foro</legend>
            <div>
                <p> Introduce tu tema: </p>
                    <input id="tema" type="text" name="tema" value="$tema" placeholder="tema" />
                    {$erroresCampos['tema']}
                <div>
                    <p> Introduce el contenido del foro: <p>
                    <input id="contenido" type="text" name="contenido" value="$contenido" placeholder="contenido" />
                    {$erroresCampos['contenido']}
                </div>
                <div>
                    <p> Seleccione la categoría del foro: <p>
                    $categorias
                    {$erroresCampos['categoria']}
                </div>
                <button type="submit" name="enviar">Crear este foro</button>
            </div>
        </fieldset>
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
            } catch (\Exception $e) {
                $this->errores[] = 'El foro no se puede insertar.';
           }
        }
    }
}