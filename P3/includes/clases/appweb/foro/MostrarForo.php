<?php
namespace appweb\foro;

class MostrarForo {

    private $_id_foro;
    private $_msgs;
    private $_foro;

    public function __construct($foro, $idforo) {
        $this->_id_foro = $idforo;
        $this->_foro = $foro;
        $this->_msgs = array();
    }

    public static function CreaMostrarForo($idforo) {
        $foro = Foro::buscaxID($idforo);
        return new MostrarForo($foro, $idforo);
    }
    public function getData() {
        $this->_msgs = Mensaje::getMsgs($this->_id_foro);
        return $this->_msgs;
    }

    public function mostrar() {
        $html = "";

        return $html;
    }
}

