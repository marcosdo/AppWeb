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

    public static function creaComida($objetivo, $tipo,  $descripcion, $link) {
        $comida = new Comidas($objetivo, $tipo,  $descripcion, $link);
        return self::inserta($comida);
    }

    public static function inserta($comida) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "INSERT INTO comidas (objetivo, tipo, descripcion, link) 
            VALUES (%d, '%s','%s','%s')"
            , $comida->objetivo
            , $conn->real_escape_string($comida->tipo)
            , $conn->real_escape_string($comida->descripcion)
            , $conn->real_escape_string($comida->link)
        );
        try {
            $conn->query($query);
            $comida->idcomida = $conn->insert_id;
            return $comida;
        } catch (\mysqli_sql_exception $e) {
            throw $e;
        }
    }

    public static function getData(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM comidas");
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

    private static function borra($idreceta) {
        return self::borraXID($idreceta->idcomida);
    }

    public static function borraXID($idreceta) {
        if (!$idreceta)
            return false;

        $result = false;

        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM comidas WHERE id_comida = %d", $idreceta);
        try {
            $result = $conn->query($query);
        }
        catch (\mysqli_sql_exception $e) {
            throw $e;
        }
        return $result;
    }

    public static function buscaxID($idreceta) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM comidas WHERE comidas.id_comida = %d", $idreceta);
        
        try {
            $rs = $conn->query($query); 
            $fila = $rs->fetch_assoc();
            if ($fila != null)
                $comida = new Comidas($fila['objetivo'], $fila['tipo'], $fila['descripcion'], $fila['link'], $idreceta);
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return $comida;
    }

    public function borrate() {
        if ($this->idcomida !== null) {
            return self::borra($this);
        }
        return false;
    }
}