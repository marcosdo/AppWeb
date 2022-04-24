<?php
namespace appweb\publicidad;

use appweb\Formulario;
use appweb\publicidad\Anuncio;


class FormularioAdminAnuncio extends Formulario {
    public function __construct() {
        parent::__construct('formAdminAnuncio', ['urlRedireccion' => 'admin.php']);
    }
    
    protected function generaCamposFormulario(&$datos) {
        $id_empresa =  $datos['id_empresa'] ?? '';
        $contenido = $datos['contenido'] ?? '';
        $imagen = $datos['imagen'] ?? '';
        $link = $datos['link'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['id_empresa', 'contenido', 'imagen', 'link'], $this->errores, 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        <h3>Crea un anuncio</h3>
        $htmlErroresGlobales
        <p class="error">{$erroresCampos['id_empresa']}</p>
        <input id="id_empresa" type="text" name="id_empresa" value="$id_empresa" placeholder="id_empresa" />
        <p class="error">{$erroresCampos['contenido']}</p>
        <input id="contenido" type="text" name="contenido" value="$contenido" placeholder="contenido" />
        <p class="error">{$erroresCampos['imagen']}</p>
        <input id="imagen" type="file" name="imagen" accept= "image/jpg"/>
        <p class="error">{$erroresCampos['link']}</p>
        <input id="link" type="text" name="link" value="$link" placeholder="link" />
        <button type="submit" name="enviar">Confirmar</button>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        // Errores posibles
        $this->errores = [];
        $imagen = $datos['imagen'] ?? '';

        $id_empresa = trim($datos['id_empresa'] ?? '');
        $id_empresa = filter_var($id_empresa, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$id_empresa || empty($id_empresa)) 
            $this->errores['id_empresa'] = 'El id de empresa no puede estar vacio.';

        $contenido = trim($datos['contenido'] ?? '');
        $contenido = filter_var($contenido, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$contenido || empty($contenido)) 
            $this->errores['contenido'] = 'El contenido no puede estar vacío.';
        
        $link = trim($datos['link'] ?? '');
        $link = filter_var($link, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$link || empty($link)) 
            $this->errores['link'] = 'El link no puede estar vacio.';


        // Si todo ha ido bien, 
        if (count($this->errores) === 0) {
            try {
                $filename = $_FILES["imagen"]["name"];
                $location = 'C:/xampp/htdocs/AW/GitHub/P4/src/img/anuncios/' . $filename;
                move_uploaded_file($_FILES["imagen"]["tmp_name"],$location);
                Anuncio::creaAnuncio($id_empresa,$contenido,$filename,$link);
            }
            catch (\Exception $e) {
                $this->errores[] = 'Imposible crear el anuncio';
            }
        }
    }
}