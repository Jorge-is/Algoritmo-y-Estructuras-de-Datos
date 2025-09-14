<?php
include_once("clases/Empleado.php");

class ListaEmpleados {
    public $inicio;

    public function __construct() {
        $this->inicio = null;
    }

    public function agregarEmpleado($codigo, $nombre, $apellido, $tipoContrato, $sueldo) {
        $empleado = new Empleado($codigo, $nombre, $apellido, $tipoContrato, $sueldo);
        
        if ($this->inicio === null) {
            $this->inicio = $empleado;
        } else {
            $temp = $this->inicio;
            while ($temp->siguiente !== null) {
                $temp = $temp->siguiente;
            }
            $temp->siguiente = $empleado;
        }
    }

    public function mostrarEmpleados() {
        $temp = $this->inicio;
        $num = 1;
        while ($temp !== null) {
            echo "<tr>";
            echo "<td>" . $num. "</td>";
            echo "<td>" . $temp->codigo . "</td>";
            echo "<td>" . $temp->nombre . "</td>";
            echo "<td>" . $temp->apellido . "</td>";
            echo "<td>" . $temp->tipoContrato . "</td>";
            echo "<td>" . "S/ ". $temp->sueldo . ".00" . "</td>";
            echo "</tr>";
            $temp = $temp->siguiente;
            $num++;
        }
    }

    // Para el PDF y Excel
    public function obtenerTodosLosEmpleados() {
        $empleados = [];
        $temp = $this->inicio;
        while ($temp !== null) {
            $empleados[] = $temp;
            $temp = $temp->siguiente;
        }
        return $empleados;
    }

    public function consultarEmpleado($codigo) {
        $temp = $this->inicio;
        while ($temp !== null) {
            if ($temp->codigo == $codigo) {
                return $temp;
            }
            $temp = $temp->siguiente;
        }
        return null;
    }

    public function actualizarEmpleado($codigo, $nombre, $apellido, $tipoContrato, $sueldo) {
        $empleado = $this->consultarEmpleado($codigo);
        if ($empleado !== null) {
            $empleado->nombre = $nombre;
            $empleado->apellido = $apellido;
            $empleado->tipoContrato = $tipoContrato;
            $empleado->sueldo = $sueldo;
            return true;
        }
        return false;
    }

    public function eliminarEmpleado($codigo) {
        $temp = $this->inicio;
        if ($temp !== null && $temp->codigo == $codigo) {
            $this->inicio = $temp->siguiente;
            return true;
        }
        while ($temp !== null && $temp->siguiente !== null) {
            if ($temp->siguiente->codigo == $codigo) {
                $temp->siguiente = $temp->siguiente->siguiente;
                return true;
            }
            $temp = $temp->siguiente;
        }
        return false;
    }
}
?>