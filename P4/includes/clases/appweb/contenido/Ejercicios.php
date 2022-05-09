<?php
namespace appweb\contenido;

use appweb\Aplicacion;

class Ejercicios {  
    // ==================== ATRIBUTOS ====================
    // ====================           ==================== 
    private $id_ejercicio;
    private $tipo;
    private $musculo;
    private $nombre;
    private $descripcion;

    // ==================== MÉTODOS ====================
    // ==================== no estaticos ====================
    // Constructor
    public function __construct($tipo, $musculo, $nombre, $descripcion, $id_ejercicio = null) {
        $this->tipo = $tipo;
        $this->musculo = $musculo;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->id_ejercicio = $id_ejercicio;
    }

    public static function creaEjercicio($tipo,  $musculo,  $nombre, $descripcion) {
        $ejercicio = new Ejercicios($tipo,  $musculo,  $nombre, $descripcion);
        return self::inserta($ejercicio);
    }

    public static function inserta($ejercicio) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "INSERT INTO ejercicios (tipo, musculo, nombre, descripcion) 
            VALUES (%d, '%s','%s','%s')"
            , $ejercicio->tipo
            , $conn->real_escape_string($ejercicio->musculo)
            , $conn->real_escape_string($ejercicio->nombre)
            , $conn->real_escape_string($ejercicio->descripcion)
        );
        try {
            $conn->query($query);
            $ejercicio->id_ejercicio = $conn->insert_id;
            return $ejercicio;
        } catch (\mysqli_sql_exception $e) {
            throw $e;
        }
    }
    
    public static function getData(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM ejercicios");
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
    public static function buscaNombre($ejercicio){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM ejercicios WHERE ejercicios.nombre = '%s'",  $conn->real_escape_string($ejercicio));
        
        try {
            $rs = $conn->query($query); 
            if($rs->num_rows) return true;  
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return false;
    }
    public static function buscaxID($id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM ejercicios WHERE ejercicios.id_ejercicio = %d", $id
        );
        try {
            $rs = $conn->query($query); 
            $fila = $rs->fetch_assoc();
            $ejercicio = new Ejercicios($fila['tipo'], $fila['musculo'], $fila['nombre'], $fila['descripcion'], $id);
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return $ejercicio;
    }

    public static function updateDescription($descripcion, $idEjercicio){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "UPDATE ejercicios SET descripcion = '%s' WHERE id_ejercicio = %d"
            , $conn->real_escape_string($descripcion)
            , $idEjercicio
        );
        $conn->query($query);
    }


    public function getId_ejercicio() { return $this->id_ejercicio; }
    public function getTipo() { return $this->tipo; }
    public function getMusculo() { return $this->musculo; }
    public function getNombre() { return $this->nombre; }
    public function getDescripcion() { return $this->descripcion; }
    

    private static function borra($idejercicio) {
        return self::borraXID($idejercicio->id_ejercicio);
    }

    public static function borraXID($idejercicio) {
        if (!$idejercicio)
            return false;

        $result = false;
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM ejercicios WHERE id_ejercicio = %d", $idejercicio);
        $result = $conn->query($query);
        return $result;
    }

    public function borrate() {
        if ($this->id_ejercicio !== null) {
            return self::borra($this);
        }
        return false;
    }

    
    public static function getEjercicios(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM ejercicios"); 
        $rs = $conn->query($query); 
        $ejercicios = array();
        while($fila = $rs->fetch_assoc()){
            $ejercicios[] = $fila["nombre"];
        }
        $rs->free();
        return $ejercicios;
    }

    public static function compararEjercicios($tabla, $select, &$antiguo, &$nuevo){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM ejercicios");
        $rs = $conn->query($query); 
        while ($fila = $rs->fetch_assoc()){
            if ($fila['nombre'] == $tabla) $antiguo = $fila['id_ejercicio'];
            if ($fila['nombre'] == $select) $nuevo = $fila['id_ejercicio'];
        }
    }

    public static function encontrarEjercicio($select){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM ejercicios");
        $rs = $conn->query($query); 
        while ($fila = $rs->fetch_assoc()){
            if ($fila['nombre'] == $select) $ejercicio = $fila['id_ejercicio'];
        }
        return $ejercicio;
    }

    public static function getTipoEjercicio($ejercicio, $conn){
        $querytipo = sprintf("SELECT * FROM ejercicios WHERE ejercicios.id_ejercicio = '%d'", $ejercicio);
        $rstipo = $conn->query($querytipo);
        $filatipo = $rstipo->fetch_assoc();
        return $filatipo['tipo'];
    }
}