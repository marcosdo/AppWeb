<?php
namespace appweb\foro;

use appweb\Formulario;
use appweb\Aplicacion;
use appweb\foro\Mensaje;
use appweb\vistas\helpers;

class FormularioForo extends Formulario {
    public function __construct() { 
        parent::__construct('formForo', ['urlRedireccion' => 'foros.php']);
    }

    protected function generaCamposFormulario(&$datos) {
        $tema = $datos['tema'] ?? '';
        $contenido = $datos['contenido'] ?? '';
        $categoria = $datos['categoria'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['tema', 'contenido', 'categoria'], $this->errores, 'span', array('class' => 'error'));
        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $categoria = seleCategorias(); 

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
        if (mb_strlen($tema) > Foro::MAX_SIZE_TITLE)
            $this->errores['tema'] = 'El tamaño del contenido introducido se ha excedido del máximo permitido.';

        $contenido = filter_var($contenido, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$contenido || empty($contenido))
            $this->errores['contenido'] = 'Es necesario rellenar el contenido del foro.';
        if (mb_strlen($contenido) > Foro::MAX_SIZE_CONTENT)
            $this->errores['contenido'] = 'El tamaño del contenido introducido se ha excedido del máximo permitido.';

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