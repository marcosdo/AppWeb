<?php
namespace appweb\contenido;

use appweb\Formulario;
use appweb\Aplicacion;

class FormularioCreaEjercicio extends Formulario {
    public function __construct() {
        parent::__construct('formCreaEjercicio');
    }

    protected function generaCamposFormulario(&$datos) {
        $tipo = $datos['tipo'] ?? '';
        $musculo = $datos['musculo'] ?? '';
        $nombre = $datos['nombre'] ?? '';
        $descripcion = $datos['descripcion'] ?? '';
        $imagen = $datos['imagen'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['tipo', 'musculo', 'nombre', 'descripcion', 'imagen'], $this->errores, 'span', array('class' => 'error'));
        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
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
        <input id="nombre" type="text" name="nombre" placeholder="nombre del ejercicio" />
        {$erroresCampos['nombre']}
        <h3>Descripcion del ejercicio</h3>
        <textarea id="descripcion" type="text" name="descripcion" placeholder="Empieza a escribir aqui..."></textarea>
        {$erroresCampos['descripcion']}
        <input type="file" name="imagen" accept="image/png" />
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
        if (!$tipo || empty($tipo))
            $this->errores['tipo'] = 'Es necesario seleccionar el objetivo';

        $musculo = filter_var($musculo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$musculo || empty($musculo))
            $this->errores['musculo'] = 'Es necesario seleccionar el tipo de musculo';

        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$nombre || empty($nombre))
            $this->errores['nombre'] = 'Es necesario proporcionar un nombre del ejercicio';

        $descripcion = filter_var($descripcion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$descripcion || empty($descripcion))
                $this->errores['descripcion'] = 'Es necesario aportar la descripcion del ejercicio';
        
        if (count($this->errores) === 0) {
            try {
                Ejercicios::creaEjercicio($tipo,  $musculo,  $nombre, $descripcion);
                $app = Aplicacion::getInstance();
                $mensajes = ['Se ha creado el ejercicio'];
                $app->putAtributoPeticion('mensajes', $mensajes);
            }
            catch (\Exception $e) {
                $this->errores[] = 'Este ejercicio ya existe.';
            }
        }
    }
}