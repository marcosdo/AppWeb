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
        $this->id_noticia = $id_noticia;
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

    public static function creaNoticia($id_profesional, $titulo,  $cuerpo, $fecha) {
        $noticia = new Noticias($id_profesional, $titulo,  $cuerpo, $fecha);
        return self::inserta($noticia);
    }
    public static function UpdateNoticia($titulo, $idNoticia){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "UPDATE noticias SET titulo = '%s' WHERE id_noticia = %d"
            , $conn->real_escape_string($titulo)
            , $idNoticia
        );
        $conn->query($query);
    }
    public static function UpdateCuerpo($cuerpo, $idNoticia){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "UPDATE noticias SET cuerpo = '%s' WHERE id_noticia = %d"
            , $conn->real_escape_string($cuerpo)
            , $idNoticia
        );
        $conn->query($query);
    }
    public static function inserta($noticia) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "INSERT INTO noticias (id_profesional, titulo, cuerpo, fecha) 
            VALUES (%d, '%s','%s','%s')"
            , $noticia->id_profesional
            , $conn->real_escape_string($noticia->titulo)
            , $conn->real_escape_string($noticia->cuerpo)
            , $conn->real_escape_string($noticia->fecha)
        );
        try {
            $conn->query($query);
            $noticia->id_noticia = $conn->insert_id;
            return $noticia;
        } catch (\mysqli_sql_exception $e) {
            throw $e;
        }
    }

    public static function buscaxID($id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM noticias WHERE noticias.id_noticia = %d", $id);
        
        try {
            $rs = $conn->query($query); 
            $fila = $rs->fetch_assoc();
                                        
            $noticia = new Noticias($fila['id_profesional'], $fila['titulo'], $fila['cuerpo'], $fila['fecha'], $id);
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
   
    private static function borra($idnoticia) {
        return self::borraXID($idnoticia->id_noticia);
    }
   
    public static function buscaTitulo($titulo){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM noticias WHERE noticias.titulo = '%s'",  $conn->real_escape_string($titulo));
        
        try {
            $rs = $conn->query($query); 
            if($rs->num_rows) return true;  
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return false;
    }

    

    public static function borraXID($idnoticia) {
        if (!$idnoticia)
            return false;

        $result = false;

        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM noticias WHERE id_noticia = %d", $idnoticia);
        try {
            $result = $conn->query($query);
        }
        catch (\mysqli_sql_exception $e) {
            throw $e;
        }
        return $result;
    }

    public function borrate() {
        if ($this->id_noticia !== null) {
            return self::borra($this);
        }
        return false;
    }
}