<?php
namespace es\ucm\fdi\aw;

class FormularioPago extends Formulario {
    public function __construct() {
        parent::__construct('formPago', ['urlRedireccion' => 'entrenadorPersonalUsu.php']);
    }
    
    protected function generaCamposFormulario(&$datos) {
        // Se reutiliza el nombre de usuario introducido previamente o se deja en blanco
        $id = $datos['peso'] ?? '';
        $id = $datos['altura'] ?? '';
        $id = $datos['alergias'] ?? '';
        $id = $datos['observaciones'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['peso', 'altura', 'alergias', 'observaciones'], $this->errores, 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend> Por favor, introduzca sus datos:</legend>
            <div>
                <label for="peso">Introduzca su peso:</label>
                <input type="text" name="peso"/>
                {$erroresCampos['peso']}
            </div>
            <div>
                <label for="altura">Introduzca su altura:</label>
                <input type="text" name="altura" />
                {$erroresCampos['altura']}
            </div>
            <div>
                <label for="alergias">Si tiene alguna alergia rellene este campo:</label>
                <input type="text" name="alergias"/>
                {$erroresCampos['alergias']}
            </div>
            <div>
                <label for="observaciones">Alguna observacion adicional:</label>
                <input type="text" name="observaciones"/>
                {$erroresCampos['observaciones']}
            </div>
            <div>
                <input type="submit" value="pagar" />
            </div>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos) {
        $this->errores = [];
        $peso = trim($datos['peso'] ?? '');
        $altura = trim($datos['altura'] ?? '');
        $alergias = trim($datos['alergias'] ?? '');
        $observaciones = trim($datos['observaciones'] ?? '');

        $peso = filter_var($peso, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$peso || empty($peso)) $this->errores['peso'] = 'El peso debe rellenarse';

        $altura = filter_var($altura, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$altura || empty($altura)) $this->errores['altura'] = 'La altura debe rellenarse';

        $alergias = filter_var($alergias, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$alergias) $this->errores['alergias'] = 'Introduzca un valor valido en alergias';

        $observaciones = filter_var($observaciones, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$observaciones) $this->errores['observaciones'] = 'Introduzca un valor valido en observaciones adicionales';
        
        if (count($this->errores) === 0) {
            $nutri = Nutri::buscaPorMenosUsuarios();
            if (!$nutri) $this->errores[] = "Ha ocurrido un problema al asignarle nutricionista";
            else {
                
            }
            $row = $resultado->fetch_assoc();
        $usuarios = $row['Usuarios'].$_SESSION['nombre']." ";
        $sql = "INSERT INTO premium (Alergias, Altura, Id_profesional, Id_usuario, Logros, Num_logros, Observaciones_adicionales, Peso) VALUES ('$alergias', '$altura', '$row[Id_profesional]', '$_SESSION[id_usuario]', '0', '0', '$observaciones', '$peso')";
        if ($conn->query($sql) === TRUE) ;
        else echo "Error: " . $sql . "<br>" . $conn->error;
        $sql = "UPDATE profesional SET Usuarios = '$usuarios' , Num_usuarios = $row[Num_usuarios]+1 WHERE Id_profesional = $row[Id_profesional]";
        if ($conn->query($sql) === TRUE) ;
        else echo "Error: " . $sql . "<br>" . $conn->error;
        $sql = "UPDATE usuario SET Premium = 1 WHERE Id_usuario = $_SESSION[id_usuario]";
        if ($conn->query($sql) === TRUE) ;
        else echo "Error: " . $sql . "<br>" . $conn->error;
        }        
    }
}
