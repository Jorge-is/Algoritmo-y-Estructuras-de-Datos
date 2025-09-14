<?php

class Empleado {
    public $codigo;
    public $nombre;
    public $apellido;
    public $tipoContrato;
    public $sueldo;
    public $siguiente;

    public function __construct($codigo, $nombre, $apellido, $tipoContrato, $sueldo) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->tipoContrato = $tipoContrato;
        $this->sueldo = $sueldo;
        $this->siguiente = null;
    }
}
?>