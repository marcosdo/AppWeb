<?php
namespace appweb\contenido;

use appweb\Aplicacion;

class Comidas {  
    // ==================== ATRIBUTOS ====================
    // ====================           ==================== 
    private $objetivo;
    private $tipo;
    private $descripcion;
    private $link;
    private $idcomida;

    // ==================== MÉTODOS ====================
    // ==================== no estaticos ====================
    // Constructor
    public function __construct($objetivo, $tipo, $descripcion, $link, $idcomida = null) {
        $this->objetivo = $objetivo;
        $this->tipo = $tipo;
        $this->descripcion = $descripcion;
        $this->link = $link;
        $this->idcomida = $idcomida;
    }

    public static function getData(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT descripcion, link FROM comidas");
        $rs = $conn->query($query);
        $result = array();
        try {
            $rs = $conn->query($query);
            while ($fila = $rs->fetch_assoc()) {
                array_push($result, $fila);
            }
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return $result;
    }

}