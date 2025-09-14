<?php

class NodoEmpleado {
    public $codigo;
    public $nombre;
    public $apellido;
    public $tipoContrato;
    public $sueldo;
    public $izquierda;
    public $derecha;

    public function __construct($codigo, $nombre, $apellido, $tipoContrato, $sueldo) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->tipoContrato = $tipoContrato;
        $this->sueldo = $sueldo;
        $this->izquierda = null;
        $this->derecha = null;
    }
}
?>