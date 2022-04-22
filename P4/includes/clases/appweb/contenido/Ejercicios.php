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
    private $imagen;

    // ==================== MÉTODOS ====================
    // ==================== no estaticos ====================
    // Constructor
    public function __construct($tipo, $musculo, $nombre, $descripcion, $imagen = null, $id_ejercicio = null) {
        $this->tipo = $tipo;
        $this->musculo = $musculo;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
        $this->id_ejercicio = $id_ejercicio;
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

    public static function buscaxID($id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM ejercicios WHERE ejercicios.id_ejercicio = %d", $id
        );
        try {
            $rs = $conn->query($query); 
            $fila = $rs->fetch_assoc();
            $ejercicio = new Ejercicios($fila['tipo'], $fila['musculo'], $fila['nombre'], $fila['descripcion'], $fila['imagen'], $fila['id_ejercicio']);
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return $ejercicio;
    }

    public function getId_ejercicio() { return $this->id_ejercicio; }
    public function getTipo() { return $this->tipo; }
    public function getMusculo() { return $this->musculo; }
    public function getNombre() { return $this->nombre; }
    public function getDescripcion() { return $this->descripcion; }
    public function getImagen() { return $this->imagen; }
}