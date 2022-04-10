<?php
namespace appweb\plan;

use appweb\Aplicacion;

class PlanificacionDietas {
    // ==================== ATRIBUTOS ====================
    // ====================           ====================
    /** @var array Array con todos los IDs de desayuno */
    private $_IDs_desayunos = array();
    /** @var array Array con todas las IDs de comidas */
    private $_IDs_almuerzos = array();
    /** @var array Array con todas las IDs de cenas */
    private $_IDs_cenas = array();
    /** @var array Array que contiene todos los nombres de desayunos */
    private $_desayuno;
    /** @var array Array que contiene todos los nombres de almuerzos */
    private $_almuerzo;
    /** @var array Array que contiene todos los nombres de cenas */
    private $_cena;
    /** @var int Dias que se hace la dieta */
    private $_dias = 0;
    /** @var string Dia de la semana que empieza */
    private $_fecha = '2020-01-01';
    // ==================== MÉTODOS ====================
    // ====================         ====================
    // Constructor
    public function __construct() {
        $bd = Aplicacion::getInstance()->getConexionBd();
        // 1.- Hay que coger la primera fecha y contar cuantos dias tiene la dieta para saber cuantas columnas tendra la tabla
        $query = sprintf(
            "SELECT dieta.fecha AS fecha FROM dieta WHERE dieta.id_usuario = %d",
            $_SESSION['id']
        );
        // Hace la consulta
        if (!($result = $bd->query($query))) {
            return false;
        }
        // Coge el numero de dias
        $this->_dias = $result->num_rows;
        // Coge la fecha de inicio de la dieta
        $fila = mysqli_fetch_assoc($result);
        $this->_fecha = $fila['fecha'];
        // Libera la memoria
        $result->free();

        // 2.- Hay que conseguir todos los IDs de las comidas
        $query = sprintf(
            "SELECT dieta.id_desayuno, dieta.id_almuerzo, dieta.id_cena FROM dieta WHERE dieta.id_usuario = %d",
            $_SESSION['id']
        );
        $result = $bd->query($query);

        while ($fila = mysqli_fetch_assoc($result)) {
            array_push($this->_IDs_desayunos, $fila['id_desayuno']);
            array_push($this->_IDs_almuerzos, $fila['id_almuerzo']);
            array_push($this->_IDs_cenas, $fila['id_cena']);
        }
        $result->free();

        // 3.- Hay que conseguir todos los nombres de las comidas
        $this->_desayuno = PlanificacionDietas::llenar_array($bd, $this->_IDs_desayunos);
        $this->_almuerzo = PlanificacionDietas::llenar_array($bd, $this->_IDs_almuerzos);
        $this->_cena = PlanificacionDietas::llenar_array($bd, $this->_IDs_cenas);
    }
    /**
     * Metodo que dados los IDs, devuelve un array de comidas
     * @var \mysqli $bd instancia de la base de datos
     * @var array $src array de enteros del que se obtienen los IDs
     * @return array|false 
     */
    private function llenar_array($bd, $src) {
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

    /**
     * Metodo que devuelve una tabla con el contenido de las comidas de la base de datos
     * La tabla tiene una columna por dia de la semana, y dos filas por cada comida { desayuno, comida, cena }
     * @return string $html Código en html de una tabla
     */
    public function muestra_tabla() {
        $fecha = $this->_fecha;
        $html = "<table id=planificacion>";
        $html .= "<caption>Planificacion de tu dieta:</caption>";
        $html .= "<thead><tr>";
        // Dias de la semana 
        $html .= "<th></th>";
        for ($i = 0; $i < $this->_dias; $i++) { 
            $dia_semana = date('w', strtotime($fecha));
            $dia_mes = date('d', strtotime($fecha));
            switch ($dia_semana) {
                case 1: { $html .= "<th>L ".$dia_mes."</th>";   } break;
                case 2: { $html .= "<th>M ".$dia_mes."</th>";   } break;
                case 3: { $html .= "<th>X ".$dia_mes."</th>";   } break;
                case 4: { $html .= "<th>J ".$dia_mes."</th>";   } break;
                case 5: { $html .= "<th>V ".$dia_mes."</th>";   } break;
                case 6: { $html .= "<th>S ".$dia_mes."</th>";   } break;
                case 0: { $html .= "<th>D ".$dia_mes."</th>";   } break;
                default: break;
            }
            $fecha = date('Y-m-d', strtotime($fecha . '+1 day'));
        }
        $html .= "</tr></thead><tbody>";
        for ($i = 0; $i < 3; $i++) {
            $html .= "<tr>";
            switch ($i) {
                case 0: $html .= "<td id=\"table-diets\">Desayuno</td>";  break;
                case 1: $html .= "<td id=\"table-diets\">Comida</td>";    break;
                case 2: $html .= "<td id=\"table-diets\">Cena</td>";      break;
                default: break;
            }
            for ($j = 0; $j < $this->_dias; $j++) {
                switch ($i) {
                    case 0: $html .= "<td>" . $this->_desayuno[$j] . "</td>";   break;
                    case 1: $html .= "<td>" . $this->_almuerzo[$j] . "</td>";     break;
                    case 2: $html .= "<td>" . $this->_cena[$j] . "</td>";       break;
                    default: break;
                }
            }
            $html .= "</tr>";
        }
        $html .= "</tbody></table>";
        return $html;
    }
}