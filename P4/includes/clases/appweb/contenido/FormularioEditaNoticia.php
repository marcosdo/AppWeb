<?php
namespace appweb\contenido;

use appweb\Formulario;
use appweb\Aplicacion;

class FormularioEditaNoticia extends Formulario {
    private $idNoticia;
    public function __construct($idNoticia) {
        parent::__construct('formEditaNoticia', ['formId' => $idNoticia]);
        $this->idNoticia = $idNoticia;
    }

    protected function generaCamposFormulario(&$datos) {
        $titulo = $datos['titulo'] ?? '';
        $cuerpo = $datos['cuerpo'] ?? '';
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['titulo', 'cuerpo'], $this->errores, 'span', array('class' => 'error'));
        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        
        <input id="titulo" type="text" name="titulo" placeholder="titulo de la noticia" />
        <i class="fa-solid fa-triangle-exclamation" id='tituloNO'></i>
        {$erroresCampos['titulo']}
        <h3>Cuerpo de la noticia</h3>
        <textarea id="cuerpo" type="text" name="cuerpo" placeholder="Empieza a escribir aqui..."></textarea>
        {$erroresCampos['cuerpo']}
        <button type="submit" name="editar">edita esta noticia</button>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) { 
        $this->errores = [];
        $titulo = $datos['titulo'] ?? '';
        $cuerpo = $datos['cuerpo'] ?? '';

        if (!empty($titulo)){
            $titulo = filter_var($titulo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$titulo) $this->errores['titulo'] = 'Es necesario aportar un titulo valido';
        }

        $titulo = filter_var($titulo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       
        if (!empty($cuerpo)){
            $cuerpo = filter_var($cuerpo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$cuerpo) $this->errores['cuerpo'] = 'Es necesario aportar un cuerpo valido';
        }       

        if (count($this->errores) === 0) {
            try {
                $app = Aplicacion::getInstance();
                if($titulo) Noticias::UpdateNoticia($titulo,$this->idNoticia);
                if($cuerpo) Noticias::UpdateCuerpo($cuerpo,$this->idNoticia); 
                $mensajes = ['Se ha editado la noticia'];
                $app->putAtributoPeticion('mensajes', $mensajes);
            }
            catch (\Exception $e) {
                $this->errores[] = 'Esta noticia ya existe.';
            }
        }
        $this->urlRedireccion = $app->buildUrl('/noticia.php', ['id' => $this->idNoticia]);
        
    }

}