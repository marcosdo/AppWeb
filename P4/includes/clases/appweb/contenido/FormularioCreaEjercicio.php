<?php
namespace appweb\contenido;

use appweb\contenido\Ejercicios;
use appweb\Formulario;
use appweb\Aplicacion;

class FormularioCreaEjercicio extends Formulario {
    public function __construct() {
        parent::__construct('formCreaEjercicio', ['urlRedireccion' => 'ejercicios.php']);
    }

    protected function generaCamposFormulario(&$datos) {
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['tipo', 'musculo', 'nombre', 'descripcion', 'imagen'], $this->errores, 'span', array('class' => 'error'));
        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        
        $html = <<<EOF
        <h3>Aqui puedes crear un ejercicio</h3>
        $htmlErroresGlobales
        <select name="tipo" id="tipo">
        <option value="" disabled="disabled" selected="selected">Selecciona el tipo de ejercicio</option>
        <option value="0">Basico</option>
        <option value="1">Normal</option>
        <option value="2">Alta repeticion</option>
        </select>
        {$erroresCampos['tipo']}
        <select name="musculo" id="musculo">
        <option value="" disabled="disabled" selected="selected">Selecciona el tipo de musculo</option>
        <option value="Hombro">Hombro</option>
        <option value="Pecho">Pecho</option>
        <option value="Espalda">Espalda</option>
        <option value="Triceps">Triceps</option>
        <option value="Biceps">Biceps</option>
        <option value="Pierna">Pierna</option>
        </select>
        {$erroresCampos['musculo']}
        <input id="nombreE" type="text" name="nombre" placeholder="nombre del ejercicio" />
        <i class="fa-solid fa-triangle-exclamation" id='ejercicioNO'></i>
        {$erroresCampos['nombre']}
        <h3>Descripcion del ejercicio</h3>
        <textarea id="descripcion" type="text" name="descripcion" placeholder="Empieza a escribir aqui..."></textarea>
        {$erroresCampos['descripcion']}
        <label for="imagen">Pulsa aqui para subir la imagen del ejercicio</label>
        <input type="file" name="imagen" accept="image/png" id="imagen"/>
        {$erroresCampos['imagen']}
        <button type="submit" name="enviar">Crea este ejercicio</button>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) { 
        $this->errores = [];
        $tipo = $datos['tipo'] ?? '';
        $musculo = $datos['musculo'] ?? '';
        $nombre = $datos['nombre'] ?? '';
        $descripcion = $datos['descripcion'] ?? '';
        $imagen = $datos['imagen'] ?? '';

        $tipo = filter_var($tipo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (($tipo != 0 && $tipo != 1 && $tipo != 2))
            $this->errores['tipo'] = 'Es necesario seleccionar el tipo';

        $musculo = filter_var($musculo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$musculo || empty($musculo))
            $this->errores['musculo'] = 'Es necesario seleccionar el tipo de musculo';

        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$nombre || empty($nombre))
            $this->errores['nombre'] = 'Es necesario proporcionar un nombre del ejercicio';

        $descripcion = filter_var($descripcion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$descripcion || empty($descripcion))
            $this->errores['descripcion'] = 'Es necesario aportar la descripcion del ejercicio';
        
        $ok = $_FILES['imagen']['error'] == UPLOAD_ERR_OK && count($_FILES) == 1;
        if (! $ok ) {
            $this->errores['imagen'] = 'Error al subir el archivo';
            return;
        }  
        $nombreimagen = $_FILES['imagen']['name'];
        $ok = self::check_file_uploaded_name($nombreimagen) && $this->check_file_uploaded_length($nombreimagen);
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($_FILES['imagen']['tmp_name']);
        $ok = preg_match('/image\/*./', $mimeType);
        if (!$ok)  $this->errores['imagen'] = 'El archivo tiene un nombre o tipo no soportado';

        if (count($this->errores) === 0) {
            try {
                $ejercicio = Ejercicios::creaEjercicio($tipo,  $musculo,  $nombre, $descripcion);
                $tmp_name = $_FILES['imagen']['tmp_name'];
                $fichero = "{$ejercicio->getId_ejercicio()}.png";
                $ruta = implode(DIRECTORY_SEPARATOR, [RUTA_ALMACEN_EJERCICIOS, $fichero]);
                if (!move_uploaded_file($tmp_name, $ruta)) {
                    $this->errores['imagen'] = $tmp_name;   
                }
                $app = Aplicacion::getInstance();
                $mensajes = ['Se ha creado el ejercicio'];
                $app->putAtributoPeticion('mensajes', $mensajes);
            }
            catch (\Exception $e) {
                $this->errores[] = 'Este ejercicio ya existe.';
            }
        }
        
    }
    
    private static function check_file_uploaded_name($filename) {
        return (bool) ((mb_ereg_match('/^[0-9A-Z-_\.]+$/i', $filename) === 1) ? true : false);
    }

    private function check_file_uploaded_length($filename) {
        return (bool) ((mb_strlen($filename, 'UTF-8') < 250) ? true : false);
    }

}