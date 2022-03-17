<?php

namespace es\ucm\fdi\aw;

class PlanificacionDietas {
    // ==================== ATRIBUTOS ====================
    // ====================           ====================
    /** @var array Array con todos los desayuno */
    private $_desayunos;
    /** @var array Array con todas las comidas */
    private $_comidas;
    /** @var array Array con todas las cenas */
    private $_cenas;
    /** @var json String que contiene todos los desayunos */
    private $_strdesayuno;
    /** @var json String que contiene todos las comidas */
    private $_strcomida;
    /** @var json String que contiene todos las cenas */
    private $_strcena;
    // ==================== MÉTODOS ====================
    // ====================         ====================
    // Constructor
    public function __construct() {
        $bd = Aplicacion::getInstance()->getConexionBd();

        $query = sprintf(
            "SELECT dieta.desayunos, dieta.comidas, dieta.cenas FROM dieta WHERE dieta.id_usuario = %d",
            $_SESSION['id']
        );

        $result = $bd->query($query);
        $result = $result->fetch_assoc();

        $this->_strdesayuno = $result['desayunos'];
        $this->_strcomida = $result['comidas'];
        $this->_strcena = $result['cenas'];

        $this->_desayunos = json_decode($this->_strdesayuno);
        $this->_comidas = json_decode($this->_strcomida);
        $this->_cenas = json_decode($this->_strcena);
    }

    public function muestra_tabla() {
        $html = "<table id=\"tabla-dietas\">";
        $html .= "<caption>Planificacion de tu dieta:</caption>";
        $html .= "<tr>";
        // Dias de la semana 
        for ($i = 0; $i < 7; $i++) { 
            switch ($i) {
                case 0: { $html .= "<th>LUNES</th>";    } break;
                case 1: { $html .= "<th>MARTES</th>";   } break;
                case 2: { $html .= "<th>MIÉRCOLES</th>";} break;
                case 3: { $html .= "<th>JUEVES</th>";   } break;
                case 4: { $html .= "<th>VIERNES</th>";  } break;
                case 5: { $html .= "<th>SÁBADO</th>";   } break;
                case 6: { $html .= "<th>DOMINGO</th>";  } break;
                default: break;
            }
        }
      
        $html .= "</tr>";

        for ($j = 0; $j < 6; $j++) {
            $html .= "<tr>";
            if (($j % 2) != 0) {
                for ($i = 0; $i < 7; $i++) {
                    switch ($j) {
                        case 1: $html .= "<td>" . $this->_desayunos[$i] . "</td>";   break;
                        case 3: $html .= "<td>" . $this->_comidas[$i] . "</td>";     break;
                        case 5: $html .= "<td>" . $this->_cenas[$i] . "</td>";       break;
                        default: break;
                    }
                }
           }
           else  {
                switch ($j) {
                    case 0: $html .= "<td colspan=\"7\" id=\"table-diets\">Desayuno</td>";  break;
                    case 2: $html .= "<td colspan=\"7\" id=\"table-diets\">Comida</td>";    break;
                    case 4: $html .= "<td colspan=\"7\" id=\"table-diets\">Cena</td>";      break;
                    default: break;
                }
            }
            $html .= "</tr>";
        }
        $html .= "</table>";

        return $html;
    }
}