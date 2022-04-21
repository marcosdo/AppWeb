<?php
namespace appweb\contenido;

use appweb\Aplicacion;

class Noticias {  
    // ==================== ATRIBUTOS ====================
    // ====================           ==================== 
    private $id_noticia;
    private $id_profesional;
    private $titulo;
    private $cuerpo;
    private $fecha;

    // ==================== MÉTODOS ====================
    // ==================== no estaticos ====================
    // Constructor
    public function __construct($id_profesional , $titulo, $cuerpo, $fecha, $id_noticia = null) {
        $this->id_profesional = $id_profesional;
        $this->titulo = $titulo;
        $this->cuerpo = $cuerpo;
        $this->fecha = $fecha;
    }

    public static function getData(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM noticias");
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
            "SELECT * FROM noticias WHERE noticias.id_noticia = %d", $id);
        
        try {
            $rs = $conn->query($query); 
            $fila = $rs->fetch_assoc();
            $noticia = new Noticias($fila['id_profesional'], $fila['titulo'], $fila['cuerpo'], $fila['fecha'], $fila['id_noticia']);
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return $noticia;
    }
    public function getId_noticia() { return $this->id_noticia; }
    public function getId_profesional() { return $this->id_profesional; }
    public function getTitulo() { return $this->titulo; }
    public function getCuerpo() { return $this->cuerpo; }
    public function getFecha() { return $this->fecha; }

}