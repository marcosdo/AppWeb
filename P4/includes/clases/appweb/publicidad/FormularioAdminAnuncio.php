<?php
namespace appweb\publicidad;

use appweb\Formulario;
use appweb\publicidad\Anuncio;


class FormularioAdminAnuncio extends Formulario {
    public function __construct() {
        parent::__construct('formAdminAnuncio', ['urlRedireccion' => 'admin.php']);
    }
    
    public static function Empresas(){
        $rts = "";
        $array = Anuncio::getEmpresas();
        for ($i=0; $i < sizeof($array); $i++) { 
            $rts = $rts ."<option value='$array[$i]'>$array[$i]</option>";
        } 
        return $rts;
    }

    protected function generaCamposFormulario(&$datos) {
        $empresa =  $datos['empresa'] ?? '';
        $contenido = $datos['contenido'] ?? '';
        $imagen = $datos['imagen'] ?? '';
        $link = $datos['link'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['empresa', 'contenido', 'imagen', 'link'], $this->errores, 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $selectEmpresas = self::Empresas();
        $html = <<<EOF
        <h3>Crea un anuncio</h3>
        $htmlErroresGlobales
        <p class="error">{$erroresCampos['empresa']}</p>
        <select id = "empresa" name = "empresa" value="$empresa">
        $selectEmpresas
        </select>
        <p class="error">{$erroresCampos['contenido']}</p>
        <input id="contenido" type="text" name="contenido" value="$contenido" placeholder="contenido" />
        <p class="error">{$erroresCampos['link']}</p>
        <input id="link" type="text" name="link" value="$link" placeholder="link" />
        <p class="error">{$erroresCampos['imagen']}</p>
        <label for="imagen">Pulsa aqui para subir la imagen del ejercicio</label>
        <input id="imagen" type="file" name="imagen" accept= "image/jpg"/>
        <button type="submit" name="enviar">Confirmar</button>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        // Errores posibles
        $this->errores = [];
        $imagen = $datos['imagen'] ?? '';

        $empresa = trim($datos['empresa'] ?? '');
        $empresa = filter_var($empresa, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$empresa || empty($empresa)) 
            $this->errores['empresa'] = 'La empresa no puede estar vacio.';

        $contenido = trim($datos['contenido'] ?? '');
        $contenido = filter_var($contenido, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$contenido || empty($contenido)) 
            $this->errores['contenido'] = 'El contenido no puede estar vacío.';
        
        $link = trim($datos['link'] ?? '');
        $link = filter_var($link, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$link || empty($link)) 
            $this->errores['link'] = 'El link no puede estar vacio.';
    
        $filename = $_FILES["imagen"]["name"];
        $ok = self::check_file_uploaded_name($filename) && $this->check_file_uploaded_length($filename);
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($_FILES['imagen']['tmp_name']);
        $ok = preg_match('/image\/*./', $mimeType);
        if (!$ok)  $this->errores['imagen'] = 'El archivo tiene un nombre o tipo no soportado';
       
        // Si todo ha ido bien, 
        if (count($this->errores) === 0) {
            try {
                $tmp_name = $_FILES['imagen']['tmp_name'];
                $ruta = implode(DIRECTORY_SEPARATOR, [RUTA_ALMACEN_ANUNCIOS,$filename]);
                if (!move_uploaded_file($tmp_name, $ruta)) {
                    $this->errores['imagen'] = 'Error al mover el archivo';
                }else Anuncio::creaAnuncio($empresa,$contenido,$filename,$link);
            }
            catch (\Exception $e) {
                $this->errores[] = 'Imposible crear el anuncio';
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