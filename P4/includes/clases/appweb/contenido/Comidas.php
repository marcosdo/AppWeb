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

    public static function getData($cond = '1'){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM comidas WHERE $cond");
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

    public static function getNombres($bd, $horario, $tipo){
        // Consulta que te devuelve descripciones de elementos que hay de ese tipo 
        $query = sprintf(
            "SELECT comidas.id_comida FROM comidas WHERE comidas.tipo = '%s' AND comidas.objetivo = %d",
            $horario, $tipo
        );
        // Si la consulta da error tratar el error
        if (!($result = $bd->query($query))) {
            error_log("Error BD ({$bd->errno}): {$bd->error}");
            exit();
        }
        // Si no, mete en un array todas las descripciones
        $ret = array();
        while ($fila = mysqli_fetch_assoc($result)) {
            array_push($ret, $fila['id_comida']);
        }
        $result->free();
        // Si no hay elementos en el array devuelve false
        if (empty($ret))
            return false;
        // En caso contrario devuelve el array
    }

    public static function getDescripciones($bd, $src) {
        $ret = array();
        for ($i = 0; $i < count($src); $i++) { 
            $query = sprintf(
                "SELECT comidas.descripcion FROM comidas WHERE comidas.id_comida = %d",
                $src[$i]
            );
            $result = $bd->query($query);
            $fila = mysqli_fetch_assoc($result);
            array_push($ret, $fila['descripcion']);
            $result->free();
        }
        return $ret;
    }

    public static function getComidasTipo($tipo){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM comidas WHERE comidas.tipo = '%s'", $tipo); 
        $rs = $conn->query($query); 
        $comidas = array();
        while($fila = $rs->fetch_assoc()){
            $comidas[] = $fila["descripcion"];
        }
        $rs->free();
        return $comidas;
    }
}