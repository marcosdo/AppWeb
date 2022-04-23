<?php
namespace appweb\contenido;

use appweb\Formulario;
use appweb\Aplicacion;

class FormularioCreaNoticia extends Formulario {
    public function __construct() {
        parent::__construct('formCreaNoticia', ['urlRedireccion' => 'noticias.php']);
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
        {$erroresCampos['titulo']}
        <h3>Cuerpo de la noticia</h3>
        <textarea id="cuerpo" type="text" name="cuerpo" placeholder="Empieza a escribir aqui..."></textarea>
        {$erroresCampos['cuerpo']}
        <button type="submit" name="enviar">Crea esta noticia</button>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) { 
        $this->errores = [];
        $titulo = $datos['titulo'] ?? '';
        $cuerpo = $datos['cuerpo'] ?? '';

        $titulo = filter_var($titulo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$titulo || empty($titulo))
            $this->errores['titulo'] = 'Es necesario poner un titulo a la noticia';

        $cuerpo = filter_var($cuerpo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$cuerpo || empty($cuerpo))
            $this->errores['cuerpo'] = 'Es necesario escribir en la noticia';

        if (count($this->errores) === 0) {
            try {
                Noticias::creaNoticia($_SESSION['id'], $titulo, $cuerpo, date_create()->format('Y-m-d'));
                $app = Aplicacion::getInstance();
                $mensajes = ['Se ha creado la noticia'];
                $app->putAtributoPeticion('mensajes', $mensajes);
            }
            catch (\Exception $e) {
                $this->errores[] = 'Esta noticia ya existe.';
            }
        }
    }
}