<?php
namespace appweb\contenido;

use appweb\Formulario;
use appweb\Aplicacion;

class FormularioEditaEjercicio extends Formulario {
    private $idEjercicio;
    public function __construct($idEjercicio) {
        parent::__construct('formEditaEjercicio', ['formId' => $idEjercicio]);
        $this->idEjercicio = $idEjercicio;
    }

    protected function generaCamposFormulario(&$datos) {
      
        $descripcion = $datos['descripcion'] ?? '';
        $imagen = $datos['imagen'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['descripcion', 'imagen'], $this->errores, 'span', array('class' => 'error'));
        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
      
        <h3>Descripcion del ejercicio</h3>
        <textarea id="descripcion" type="text" name="descripcion" placeholder="Empieza a escribir aqui..."></textarea>
        {$erroresCampos['descripcion']}
        <label for="imagen">Pulsa aqui para subir la imagen del ejercicio</label>
        <input type="file" name="imagen" accept="image/png" id="imagen"/>
        {$erroresCampos['imagen']}
        <button type="submit" name="editar">Editar este ejercicio</button>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) { 
        $this->errores = [];
       
        $descripcion = $datos['descripcion'] ?? '';
        $imagen = $datos['imagen'] ?? '';

        if (!empty($descripcion)){
            $descripcion = filter_var($descripcion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$descripcion) $this->errores['descripcion'] = 'Es necesario aportar la descripcion del ejercicio';
        }
         
        $ok = $_FILES['imagen']['error'] == UPLOAD_ERR_OK && count($_FILES) == 1;
        
        if($ok){
            $nombreimagen = $_FILES['imagen']['name'];
            $ok = self::check_file_uploaded_name($nombreimagen) && $this->check_file_uploaded_length($nombreimagen);
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($_FILES['imagen']['tmp_name']);
            $ok = preg_match('/image\/*./', $mimeType);
            if (!$ok)  $this->errores['imagen'] = 'El archivo tiene un nombre o tipo no soportado';
        }

        if (count($this->errores) === 0) {
            try {
                
                if($descripcion) {
                    Ejercicios::updateDescription($descripcion, $this->idEjercicio);
                }
                
                if($ok){
                    $tmp_name = $_FILES['imagen']['tmp_name'];
                    $fichero = "{$this->idEjercicio}.png";
                    $ruta = implode(DIRECTORY_SEPARATOR, [RUTA_ALMACEN_EJERCICIOS, $fichero]);
                    if (!move_uploaded_file($tmp_name, $ruta)) {
                        $this->errores['imagen'] = 'Error al mover el archivo';
                    }
                }
               
                $app = Aplicacion::getInstance();
                $mensajes = ['Se ha editado el ejercicio'];
                $app->putAtributoPeticion('mensajes', $mensajes);
            }
            catch (\Exception $e) {
                $this->errores[] = 'Este ejercicio ya existe.';
            }
        }
        $this->urlRedireccion = $app->buildUrl('/ejercicio.php', ['id' => $this->idEjercicio]);
        
    }
    
    private static function check_file_uploaded_name($filename) {
        return (bool) ((mb_ereg_match('/^[0-9A-Z-_\.]+$/i', $filename) === 1) ? true : false);
    }

    private function check_file_uploaded_length($filename) {
        return (bool) ((mb_strlen($filename, 'UTF-8') < 250) ? true : false);
    }

}