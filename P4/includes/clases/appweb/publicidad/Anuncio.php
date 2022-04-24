<?php
namespace appweb\publicidad;

use appweb\Aplicacion;
class Anuncio {
    // ==================== ATRIBUTOS ====================
    // ====================           ====================
    private $id_empresa;
    private $contenido;
    private $imagen;
    private $link;
    private $id_anuncio;
    // ==================== MÉTODOS ====================
    // Constructor
    public function __construct($id_empresa, $contenido, $imagen, $link, $id_anuncio = null) {
        $this->id_empresa = $id_empresa;
        $this->contenido = $contenido;
        $this->imagen = $imagen;
        $this->link = $link;
        $this->id_anuncio = $id_anuncio;
    }
    


    public static function creaAnuncio($id_empresa, $contenido,  $imagen, $link) {
        $anuncio = new Anuncio($id_empresa, $contenido, $imagen, $link);
        return self::inserta($anuncio);
    }

    public static function inserta($anuncio) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
        "INSERT INTO anuncio (id_empresa, contenido, imagen, link) 
        VALUES (%d, '%s', '%s', '%s')"
        , $anuncio->id_empresa
        , $conn->real_escape_string($anuncio->contenido)
        , $conn->real_escape_string($anuncio->imagen)
        , $conn->real_escape_string($anuncio->link));
        try {
            $conn->query($query);
            $anuncio->_id_mensaje = $conn->insert_id;
            return $anuncio;
        } catch (\mysqli_sql_exception $e) {
            throw $e;
        }
    }
}