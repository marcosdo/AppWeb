<?php
namespace appweb\productos;

use appweb\Aplicacion;

class Empresas {
    // ==================== CONSTANTES ====================
    // ====================            ====================

    // ==================== ATRIBUTOS ====================
    // ====================           ====================
    protected $_id_empresa;
    protected $_nombre_empresa;
    // ==================== METODOS ====================
    // ==================== no estaticos ====================
    // Constructor
    private function __construct($nombre, $id = null) {
        $this->_id_empresa = $id;
        $this->_nombre_empresa = $nombre;
    }

    private function inserta($empresas) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "INSERT INTO empresas (id_empresa, nombre) VALUES (%d, '%s')"
            , $empresas->_id_empresa
            , $empresas->_nombre_empresa
        );
        try {
            $conn->query($query);
            $empresas->_id = $conn->insert_id;
            return $empresas;
        } catch (\mysqli_sql_exception $e) {
            if ($conn->sqlstate == 23000) // código de violación de restricción de integridad (PK)
                throw new \Exception("Ya existe la empresa");
            throw $e;
        }
    }
    // Getters y setters

    // ====================  METODOS  ====================
    // ==================== estaticos ====================
    public static function CreaEmpresas($nombre, $id = null) {
        $emp = new Empresas($nombre, $id);
        return $emp->inserta($emp);
    }

    public static function getData() {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT * FROM empresas ORDER BY id_empresa"
        );
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

    public static function getNombresEmpresas() {
        $empresas = array();
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT nombre FROM empresas"
        );
        try {
            $rs = $conn->query($query);
            while($fila = $rs->fetch_assoc()){ 
                array_push($empresas, $fila["nombre"]);
            }
        }
        finally {
            if ($rs != null)
                $rs->free();
        }
        return $empresas;
    }

    public static function getIDsEmpresas(){
        $empresas = array();
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT id_empresa FROM empresas"
        );
        try {
            $rs = $conn->query($query);
            while($fila = $rs->fetch_assoc())
                array_push($empresas, $fila["id_empresa"]);
        }
        finally {
            if ($rs != null)
                $rs->free();
        }
        return $empresas;
    }
}