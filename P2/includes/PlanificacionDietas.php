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
        $array = $result->fetch_assoc();
        $result->free();
        
        $this->_strdesayuno = $array['desayunos'];
        $this->_strcomida = $array['comidas'];
        $this->_strcena = $array['cenas'];

        $this->_desayunos = json_decode($this->_strdesayuno);
        $this->_comidas = json_decode($this->_strcomida);
        $this->_cenas = json_decode($this->_strcena);
    }

    /**
     * Metodo que devuelve una tabla con el contenido de las comidas de la base de datos
     * La tabla tiene una columna por dia de la semana, y dos filas por cada comida { desayuno, comida, cena }
     * @return string $html Código en html de una tabla
     */
    public function muestra_tabla() {
        $html = "<table id=\"tabla-dietas\">";
        $html .= "<caption>Planificacion de tu dieta:</caption>";
        $html .= "<tr>";
        // Dias de la semana 
        for ($i = 0; $i < 8; $i++) { 
            switch ($i) {
                case 0: { $html .= "<th></th>";     } break;
                case 1: { $html .= "<th>L</th>";    } break;
                case 2: { $html .= "<th>M</th>";    } break;
                case 3: { $html .= "<th>X</th>";    } break;
                case 4: { $html .= "<th>J</th>";    } break;
                case 5: { $html .= "<th>V</th>";    } break;
                case 6: { $html .= "<th>S</th>";    } break;
                case 7: { $html .= "<th>D</th>";    } break;
                default: break;
            }
        }
      
        $html .= "</tr>";

        for ($i = 0; $i < 3; $i++) {
            $html .= "<tr>";
            switch ($i) {
                case 0: $html .= "<td id=\"table-diets\">Desayuno</td>";  break;
                case 1: $html .= "<td id=\"table-diets\">Comida</td>";    break;
                case 2: $html .= "<td id=\"table-diets\">Cena</td>";      break;
                default: break;
            }
            for ($j = 0; $j < 7; $j++) {
                switch ($i) {
                    case 0: $html .= "<td>" . $this->_desayunos[$j] . "</td>";   break;
                    case 1: $html .= "<td>" . $this->_comidas[$j] . "</td>";     break;
                    case 2: $html .= "<td>" . $this->_cenas[$j] . "</td>";       break;
                    default: break;
                }
            }
            $html .= "</tr>";
        }
        $html .= "</table>";

        return $html;
    }
}