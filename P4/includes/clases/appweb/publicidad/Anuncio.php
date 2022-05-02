<?php
namespace appweb\publicidad;

use appweb\Aplicacion;
class Anuncio {
    // ==================== ATRIBUTOS ====================
    // ====================           ====================
    private $empresa;
    private $contenido;
    private $imagen;
    private $link;
    private $id_anuncio;
    // ==================== MÉTODOS ====================
    // Constructor
    public function __construct($empresa, $contenido, $imagen, $link, $id_anuncio = null) {
        $this->empresa = $empresa;
        $this->contenido = $contenido;
        $this->imagen = $imagen;
        $this->link = $link;
        $this->id_anuncio = $id_anuncio;
    }
    


    public static function creaAnuncio($empresa, $contenido,  $imagen, $link) {
        $anuncio = new Anuncio($empresa, $contenido, $imagen, $link);
        return self::inserta($anuncio);
    }

    public static function inserta($anuncio) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
        "INSERT INTO anuncio (nombre_empresa, contenido, imagen, link) 
        VALUES ('%s', '%s', '%s', '%s')"
        , $conn->real_escape_string($anuncio->empresa)
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
    public static function getEmpresas(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM empresas"); 
        $rs = $conn->query($query);
        if($rs){
            $array = array();
            while($fila = $rs->fetch_assoc()) array_push($array,$fila["nombre"]);
            $rs->free();
            return $array;
        } else error_log("Error BD ({$conn->errno}): {$conn->error}");
    }
}