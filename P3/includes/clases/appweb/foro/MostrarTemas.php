<?php
namespace appweb\foro;

use appweb\Aplicacion;

class MostrarTemas { 
    public function __construct() {}

    public function getData() {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM foro"
        );
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