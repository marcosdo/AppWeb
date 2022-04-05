<?php
namespace es\ucm\fdi\aw;

class Foro {
    
    private $_idusuario;
    private $_fecha;
    private $_tema;
    private $_categoria;
    private $_alias;
    private $_contenido;

    public function __construct($alias, $idusuario, $fecha, $tema, $contenido, $categoria) {
        $this->_fecha = $fecha;
        $this->_tema = $tema;
        $this->_categoria = $categoria;
        $this->_alias = $alias;
        $this->_contenido = $contenido;
        $this->_idusuario = $idusuario;
    }

    public static function crearForo($alias, $idusuario, $fecha, $tema, $contenido, $categoria) {
        $foro = new Foro($alias, $idusuario, $fecha, $tema, $contenido, $categoria);
        return self::inserta($foro);
    }

    public static function inserta($foro) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "INSERT INTO foro (id_usuario, tema, fecha, contenido, categoria, respuestas, nickcreador) 
            VALUES (%d, '%s', '%s', '%s', '%s', %d, '%s')"
            , $foro->_idusuario
            , $conn->real_escape_string($foro->_tema)
            , $conn->real_escape_string($foro->_fecha)
            , $conn->real_escape_string($foro->_contenido)
            , $conn->real_escape_string($foro->_categoria)
            , $foro->_respuestas
            , $conn->real_escape_string($foro->_alias)
        );
        try {
            $conn->query($query);
            $foro->id = $conn->insert_id;
            return $foro;
        } catch (\mysqli_sql_exception $e) {
            if ($conn->sqlstate == 23000) { // código de violación de restricción de integridad (PK)
                throw new UsuarioYaExisteException("Ya existe el usuario {$foro->idforo}");
            }
            throw $e;
        }
    }
}
