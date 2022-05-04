<?php
namespace appweb\productos;

use appweb\Aplicacion;
use appweb\usuarios\Premium;
use appweb\usuarios\Profesional;
use appweb\plan\Dieta;
use appweb\plan\Rutina;




class Productos {
    // ==================== CONSTANTES ====================
    // ====================           ====================
    

    // ==================== ATRIBUTOS ====================
    // ====================           ====================
  
    private $empresa;
    private $nombre;
    private $descripcion;
    private $precio;
    private $link;
    private $tipo;

    // ==================== MÉTODOS ====================
    // ==================== no estaticos ====================

    public function getLink() { return $this->link; }
    public function getTipo() { return $this->tipo; }
    public function getPrecio() { return $this->precio; }
    public function getEmpresa() { return $this->empresa; }
    public function getNombre() { return $this->nombre; }
    public function getDescripcion() { return $this->descripcion; }


    // Constructor

    public function __construct($id = null, $empresa, $nombre, $descripcion, $precio, $link, $tipo) {
        $this->empresa = $empresa;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->link = $link;
        $this->tipo = $tipo;
    }
   
    // Getters y setters
  
    // ====================  MÉTODOS  ====================
    // ==================== estaticos ====================

    public static function buscaProducto($id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM productos WHERE productos.id_producto = %d", $id
        );
        try {
            $rs = $conn->query($query); 
            $fila = $rs->fetch_assoc();
            $nombreEmpresa = self::getNombreEmpresa($fila['id_empresa']);
            $producto = new Productos($id, $nombreEmpresa, $fila['nombre'], $fila['descripcion'], $fila['precio'], $fila['link'], $fila['tipo']);
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return $producto;
    }

    private static function getNombreEmpresa ($id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM empresas WHERE empresas.id_empresa = %d", $id
        );
        $rs = $conn->query($query); 
        $fila = $rs->fetch_assoc();
        return $fila['nombre'];
    }

    /**
     * guardar en una lista todos los productos para usuarios sin plan
     * @return array
     */
    public static function getProductos(&$ids, &$nombres, &$empresa, &$descripcion, &$precio, &$link, &$tipo){
        $ids = array();
        $nombres = array();
        $empresa = array();
        $descripcion = array();
        $precio = array();
        $link = array();
        $tipo = array(); 
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM productos");
        $rs = $conn->query($query);
        while($fila = $rs->fetch_assoc()){ 
            array_push($ids, $fila["id_producto"]);
            array_push($nombres, $fila["nombre"]);
            array_push($descripcion, $fila["descripcion"]);
            array_push($precio, $fila["precio"]);
            array_push($link, $fila["link"]);
            array_push($tipo, $fila["tipo"]);
            $queryempresa = sprintf("SELECT * FROM empresas WHERE empresas.id_empresa = %d", $fila["id_empresa"]);
            $rsempresa = $conn->query($queryempresa);
            $filaempresa = $rsempresa->fetch_assoc();
            array_push($empresa, $filaempresa["nombre"]);
        } 
        
        return $rs; 
    }

    public static function getData(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM productos");
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

    public static function getDataPers(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM productos");
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

    public static function getEmpresas(){
        $empresas = array();
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM empresas");
        $rs = $conn->query($query);
        while($fila = $rs->fetch_assoc()){ 
            array_push($empresas, $fila["nombre"]);
        } 
        return $empresas;    
    }

    public static function getTipos(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SHOW COLUMNS FROM productos WHERE Field = '%s'",
            "tipo"
        );
        $rs = $conn->query($query);

        $fila = $rs->fetch_assoc();
        $type = $fila['Type'];
        $matches = array();
        $enum = array();
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);

        return $enum;
    }


    public static function getProducto($id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM productos WHERE productos.id_producto = %d", $id
        );
        try {
            $rs = $conn->query($query); 
            $fila = $rs->fetch_assoc();
            $query2 = sprintf("SELECT * FROM empresas WHERE empresas.id_empresa = %d", $fila['id_empresa']);
            $rs2 = $conn->query($query2); 
            $fila2 = $rs->fetch_assoc();

            $producto = new Productos($fila['nombre'], $fila['descripcion'], $fila['precio'], $fila['link'], $fila['tipo'], $id, $fila2['nombre']);
        } finally {
            if ($rs != null)
                $rs->free();
        }
        return $producto;
    }
    
    public static function getPrecioMaximo(){
        $precio = 0;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM `productos`");
        $rs = $conn->query($query);
        while($fila = $rs->fetch_assoc()){ 
            if($fila["precio"] > $precio) $precio = $fila["precio"];
        } 
        return $precio; 
    }

    private static function getDatosSeguimiento($idUsuario, &$peso, &$altura){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM `premium` WHERE premium.id_usuario = '%d'", $idUsuario);
        $rs = $conn->query($query);
        $fila = $rs->fetch_assoc();
        $peso = $fila['peso'];
        $altura = $fila['altura'];
    }

    

    public static function personalizaProductos($idUsuario){
        self::getDatosSeguimiento($idUsuario, $peso, $altura);
        $objetivoDieta = Dieta::getObjetivoDieta($idUsuario);
        $objetivoRutina = Rutina::getObjetivoRutina($idUsuario, $nivelRutina);
        $productosTipos = array();
        $imc = $peso / pow($altura, 2);
        switch ($objetivoDieta){
            case 1: // Pérdida
                array_push($productosTipos, "preentreno");
                break;
            case 2: // Ganancia
                if($imc <= 25){
                    array_push($productosTipos, "gainer");
                }
                break;
            case 3: // Mantener
                if($imc > 18){
                    array_push($productosTipos, "preentreno");
                }
                break;
        }

        switch($objetivoRutina){
            case 1: // Fuerza
                array_push($productosTipos, "proteina");
                if($nivelRutina == 2){
                    array_push($productosTipos, "creatina");
                }
                else if($nivelRutina == 3){
                    array_push($productosTipos, "creatina");
                    array_push($productosTipos, "aminoacidos");
                }
                break;
            case 2: // Hipertrofia
                array_push($productosTipos, "proteina");
                if($nivelRutina == 2){
                    array_push($productosTipos, "creatina");
                }
                else if($nivelRutina == 3){
                    array_push($productosTipos, "creatina");
                    array_push($productosTipos, "caseina");
                }
                break;
            case 3: // Resistencia
                array_push($productosTipos, "proteina");
                if($nivelRutina >= 2){
                    array_push($productosTipos, "aminoacidos");
                }
                break;

        }
        self::actualizarProductosRecomendados($idUsuario,$productosTipos);
        
    }

    private static function actualizarProductosRecomendados($idUsuario, $productosTipos){

    }

    public static function haySeguimiento($idUsuario){
        if(!Profesional::usuarioSeguimiento($idUsuario)) return false;
        else return true;
    }


    public static function hayRutina($idUsuario){
        $app = Aplicacion::getInstance();
        if(!Rutina::hayRutinas($idUsuario, $app)) return false;
        else return true;

    }

    public static function hayDieta($idUsuario){
        if(!Dieta::hayDietas(($idUsuario))) return false;
        else return true;
    }
    

    
}