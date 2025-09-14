<?php

class Empleado {
    public $codigo;
    public $nombre;
    public $apellido;
    public $sexo;
    public $sueldo;
    public $siguiente;
    public $anterior;

    public function __construct($codigo, $nombre, $apellido, $sexo, $sueldo) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->sexo = $sexo;
        $this->sueldo = $sueldo;
        $this->siguiente = null;
        $this->anterior = null;
    }
}
?>