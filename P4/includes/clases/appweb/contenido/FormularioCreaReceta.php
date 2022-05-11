<?php
namespace appweb\contenido;

use appweb\Formulario;
use appweb\Aplicacion;

class FormularioCreaReceta extends Formulario {
    public function __construct() {
        parent::__construct('formCreaReceta', ['urlRedireccion' => 'recetas.php']);
    }

    protected function generaCamposFormulario(&$datos) {
        $objetivo = $datos['objetivo'] ?? '';
        $tipo = $datos['tipo'] ?? '';
        $descripcion = $datos['descripcion'] ?? '';
        $link = $datos['link'] ?? '';
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['objetivo', 'tipo', 'descripcion', 'link'], $this->errores, 'span', array('class' => 'error'));
        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        <h3>Aqui puedes crear una receta</h3>
        $htmlErroresGlobales
        <select name="objetivo" id="objetivo">
        <option value="" disabled="disabled" selected="selected">Selecciona el tipo de comida</option>
        <option value="1">Pérdida de peso</option>
        <option value="2">Ganancia de peso</option>
        <option value="3">Mantener peso</option>
        </select>
        {$erroresCampos['objetivo']}
        <select name="tipo" id="tipo">
        <option value="" disabled="disabled" selected="selected">Selecciona el tipo de comida</option>
        <option value="Desayuno">Desayuno</option>
        <option value="Comida">Comida</option>
        <option value="Cena">Cena</option>
        </select>
        {$erroresCampos['tipo']}
        <input id="descripcion" type="text" name="descripcion" value="$descripcion" placeholder="descripcion de la comida" />
        {$erroresCampos['descripcion']}
        <input id="link" type="text" name="link" value="$link" placeholder="id del video youtube" />
        {$erroresCampos['link']}
        <button type="submit" name="enviar">Crea esta receta</button>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) { 
        $this->errores = [];
        $objetivo = $datos['objetivo'] ?? '';
        $tipo = $datos['tipo'] ?? '';
        $descripcion = $datos['descripcion'] ?? '';
        $link = $datos['link'] ?? '';

        $objetivo = filter_var($objetivo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$objetivo || empty($objetivo))
            $this->errores['objetivo'] = 'Es necesario seleccionar el objetivo de la comida';

        $tipo = filter_var($tipo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$tipo || empty($tipo))
            $this->errores['tipo'] = 'Es necesario seleccionar el tipo de comida';

        $descripcion = filter_var($descripcion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$descripcion || empty($descripcion))
            $this->errores['descripcion'] = 'Es necesario proporcionar una descripcion de comida';

        $link = filter_var($link, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$link || empty($link))
            $this->errores['link'] = 'Es necesario aportar el link de la receta en youtube';
        
        if (count($this->errores) === 0) {
            try {
                Comidas::creaComida($objetivo, $tipo, $descripcion, $link);
                $app = Aplicacion::getInstance();
                $mensajes = ['Se ha creado la comida'];
                $app->putAtributoPeticion('mensajes', $mensajes);
            }
            catch (\Exception $e) {
                $this->errores[] = 'Esta comida ya existe.';
            }
        }
    }
}