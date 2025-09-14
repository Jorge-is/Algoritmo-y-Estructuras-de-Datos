<?php
include_once("clases/Empleado.php");

class ListaEmpleados {
    public $inicio;

    function __construct() {
        $this->inicio = null;
    }

    function guardarEmpleado($codigo, $nombre, $apellido, $sexo, $sueldo) {
        $nuevoEmpleado = new Empleado($codigo, $nombre, $apellido, $sexo, $sueldo);
        if ($this->inicio == null) {
            $this->inicio = $nuevoEmpleado;
        } else {
            $actual = $this->inicio;
            while ($actual->siguiente != null) {
                $actual = $actual->siguiente;
            }
            $actual->siguiente = $nuevoEmpleado;
            $nuevoEmpleado->anterior = $actual;
        }
    }
    
    function mostrarEmpleadosAdelante() {
        $actual = $this->inicio;
        while ($actual != null) {
            echo "<tr>";
            echo "<td>" . $actual->codigo . "</td>";
            echo "<td>" . $actual->nombre . "</td>";
            echo "<td>" . $actual->apellido . "</td>";
            echo "<td>" . $actual->sexo . "</td>";
            echo "<td>" . "S/ ". $actual->sueldo . ".00" . "</td>";
            echo "</tr>";
            $actual = $actual->siguiente;
        }
    }
    
    function mostrarEmpleadosAtras() {
        $actual = $this->inicio;
        while ($actual->siguiente != null) {
            $actual = $actual->siguiente;
        }
        while ($actual != null) {
            echo "<tr>";
            echo "<td>" . $actual->codigo . "</td>";
            echo "<td>" . $actual->nombre . "</td>";
            echo "<td>" . $actual->apellido . "</td>";
            echo "<td>" . $actual->sexo . "</td>";
            echo "<td>" . "S/ ". $actual->sueldo . ".00" . "</td>";
            echo "</tr>";
            $actual = $actual->anterior;
        }
    }

    function consultarEmpleado($codigo) {
        $actual = $this->inicio;
        while ($actual != null) {
            if ($actual->codigo == $codigo) {
                return $actual;
            }
            $actual = $actual->siguiente;
        }
        return null; // Si no se encuentra el empleado con el código dado
    }

    function actualizarEmpleado($codigo, $nombre, $apellido, $sexo, $sueldo) {
        $empleado = $this->consultarEmpleado($codigo);
        if ($empleado != null) {
            $empleado->nombre = $nombre;
            $empleado->apellido = $apellido;
            $empleado->sexo = $sexo;
            $empleado->sueldo = $sueldo;
        }
    }

    function eliminarEmpleado($codigo) {
        $actual = $this->inicio;
        while ($actual != null) {
            if ($actual->codigo == $codigo) {
                if ($actual->anterior == null) {
                    $this->inicio = $actual->siguiente;
                    if ($actual->siguiente != null) {
                        $actual->siguiente->anterior = null;
                    }
                } else {
                    $actual->anterior->siguiente = $actual->siguiente;
                    if ($actual->siguiente != null) {
                        $actual->siguiente->anterior = $actual->anterior;
                    }
                }
                unset($actual); // Liberar memoria
                return;
            }
            $actual = $actual->siguiente;
        }
    }
}
?>