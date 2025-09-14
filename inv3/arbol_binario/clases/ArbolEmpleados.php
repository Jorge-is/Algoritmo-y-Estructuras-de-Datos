<?php
include_once("clases/NodoEmpleado.php");

class ArbolEmpleados {
    public $raiz;

    public function __construct() {
        $this->raiz = null;
    }

    // Guardar un empleado en el árbol
    public function insertar($codigo, $nombre, $apellido, $tipoContrato, $sueldo) {
        $nuevoNodo = new NodoEmpleado($codigo, $nombre, $apellido, $tipoContrato, $sueldo);
        if ($this->raiz === null) {
            $this->raiz = $nuevoNodo;
        } else {
            $this->insertarNodo($this->raiz, $nuevoNodo);
        }
    }

    private function insertarNodo($nodo, $nuevoNodo) {
        if ($nuevoNodo->codigo < $nodo->codigo) {
            if ($nodo->izquierda === null) {
                $nodo->izquierda = $nuevoNodo;
            } else {
                $this->insertarNodo($nodo->izquierda, $nuevoNodo);
            }
        } else {
            if ($nodo->derecha === null) {
                $nodo->derecha = $nuevoNodo;
            } else {
                $this->insertarNodo($nodo->derecha, $nuevoNodo);
            }
        }
    }

    // Mostrar todos los empleados en la tabla
    public function mostrarEmpleados($nodo = null, &$contador = 1) {
        if ($nodo === null) {
            $nodo = $this->raiz;
        }
        if ($nodo !== null) {
            if ($nodo->izquierda !== null) {
                $this->mostrarEmpleados($nodo->izquierda, $contador);
            }
            echo "<tr>";
            echo "<td>" . $contador . "</td>";
            echo "<td>" . $nodo->codigo . "</td>";
            echo "<td>" . $nodo->nombre . "</td>";
            echo "<td>" . $nodo->apellido . "</td>";
            echo "<td>" . $nodo->tipoContrato . "</td>";
            echo "<td>S/ " . $nodo->sueldo . ".00</td>";
            echo "</tr>";
            $contador++;
            if ($nodo->derecha !== null) {
                $this->mostrarEmpleados($nodo->derecha, $contador);
            }
        }
    }

    // Consultar un empleado por código
    public function buscar($codigo) {
        return $this->buscarNodo($this->raiz, $codigo);
    }

    private function buscarNodo($nodo, $codigo) {
        if ($nodo === null) {
            return null;
        }
        if ($codigo === $nodo->codigo) {
            return $nodo;
        }
        if ($codigo < $nodo->codigo) {
            return $this->buscarNodo($nodo->izquierda, $codigo);
        } else {
            return $this->buscarNodo($nodo->derecha, $codigo);
        }
    }

    // Actualizar un empleado por código
    public function actualizar($codigo, $nombre, $apellido, $tipoContrato, $sueldo) {
        $nodo = $this->buscar($codigo);
        if ($nodo !== null) {
            $nodo->nombre = $nombre;
            $nodo->apellido = $apellido;
            $nodo->tipoContrato = $tipoContrato;
            $nodo->sueldo = $sueldo;
            return true;
        }
        return false;
    }

    // Eliminar un empleado por código
    public function eliminar($codigo) {
        $this->raiz = $this->eliminarNodo($this->raiz, $codigo);
    }

    private function eliminarNodo($nodo, $codigo) {
        if ($nodo === null) {
            return null;
        }
        if ($codigo < $nodo->codigo) {
            $nodo->izquierda = $this->eliminarNodo($nodo->izquierda, $codigo);
        } elseif ($codigo > $nodo->codigo) {
            $nodo->derecha = $this->eliminarNodo($nodo->derecha, $codigo);
        } else {
            // Nodo con solo un hijo o sin hijos
            if ($nodo->izquierda === null) {
                return $nodo->derecha;
            } elseif ($nodo->derecha === null) {
                return $nodo->izquierda;
            }

            // Nodo con dos hijos: obtener el sucesor en orden (el más pequeño en el subárbol derecho)
            $nodo->codigo = $this->minValorNodo($nodo->derecha)->codigo;
            $nodo->derecha = $this->eliminarNodo($nodo->derecha, $nodo->codigo);
        }
        return $nodo;
    }

    private function minValorNodo($nodo) {
        $actual = $nodo;
        while ($actual->izquierda !== null) {
            $actual = $actual->izquierda;
        }
        return $actual;
    }

    // Para el PDF y Excel
    // Obtener todos los empleados con recorrido en in-orden
    public function obtenerTodosLosEmpleados($nodo = null, &$empleados = []) {
        if ($nodo === null) {
            $nodo = $this->raiz;
        }
        if ($nodo !== null) {          
            if ($nodo->izquierda !== null) {
                $this->obtenerTodosLosEmpleados($nodo->izquierda, $empleados);
            }
            $empleados[] = $nodo;
            if ($nodo->derecha !== null) {
                $this->obtenerTodosLosEmpleados($nodo->derecha, $empleados);
            }
        }
        return $empleados;
    }
}
?>