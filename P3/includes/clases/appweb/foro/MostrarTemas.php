<?php
namespace appweb\foro;

use appweb\Aplicacion;

class MostrarTemas { 
    public function __construct() {}
    public function muestra_temas() {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM foro");
        $rs = $conn->query($query); 
        
        $contenido = "<caption>Lista de temas:</caption>"; 
        while($fila = $rs->fetch_assoc()){ 
            $contenido .= "<li><a href='MostrarForo.php'>$fila[tema]</a></li>";
        }
        $rs->free();
        $html = <<<EOF
        $contenido
        EOF;
        return $html;
    }
}