<?php 

require_once('clases/ArbolEmpleados.php');

$respuesta_consulta = "";
$respuesta_codigo = "";
$respuesta_nombre = "";
$respuesta_apellido = "";
$respuesta_tipoContrato = "";
$respuesta_sueldo = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['codigo']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['tipoContrato']) &&isset($_POST['sueldo'])) {

    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $tipoContrato = $_POST['tipoContrato'];
    $sueldo = $_POST['sueldo'];

    session_start();
    if (empty($_SESSION['arbol'])) {
        $_SESSION['arbol'] = new ArbolEmpleados();
    }
        $arbolEmpleados = $_SESSION['arbol'];
    if(isset($_POST['guardar'])) {
        //Validar que no se registre un empleado con el mismo código
        if ($arbolEmpleados->buscar($codigo) !== null) {
            $respuesta_consulta = "<div class='mensaje-error'>El empleado con el código $codigo ya está registrado.</div>";
        }else{
            $empleado_guardar = $arbolEmpleados->insertar($codigo, $nombre, $apellido, $tipoContrato, $sueldo);
            $respuesta_consulta = "<div class='mensaje-exitoso'>Guardado correctamente.</div>";
        }       
    }elseif(isset($_POST['consultar'])) {
        // Obtener el código del empleado a consultar
        $codigo_consulta = $_POST['codigo'];
        // Consultar al empleado
        $empleado_consultado = $arbolEmpleados->buscar($codigo_consulta);
        // Verificar si se encontró al empleado
        if ($empleado_consultado !== null) {
            // Mostrar los detalles del empleado
            $respuesta_codigo = $empleado_consultado->codigo;
            $respuesta_nombre = $empleado_consultado->nombre;
            $respuesta_apellido = $empleado_consultado->apellido;
            $respuesta_tipoContrato = $empleado_consultado->tipoContrato;
            $respuesta_sueldo = $empleado_consultado->sueldo;
            $respuesta_consulta = "<div class='mensaje-exitoso'>Empleado encontrado.</div>";
        } else {
            // Mostrar un mensaje si no se encontró al empleado
            $respuesta_consulta = "<div class='mensaje-error'>Empleado no encontrado.</div>";
        }
    } elseif(isset($_POST['actualizar'])) {
        // Obtener los datos actualizados del empleado
        $codigo_actualizar = $_POST['codigo'];
        $nombre_actualizar = $_POST['nombre'];
        $apellido_actualizar = $_POST['apellido'];
        $tipoContrato_actualizar = $_POST['tipoContrato'];
        $sueldo_actualizar = $_POST['sueldo'];
        // Actualizar al empleado
        $resultado_actualizacion = $arbolEmpleados->actualizar($codigo_actualizar, $nombre_actualizar, $apellido_actualizar, $tipoContrato_actualizar, $sueldo_actualizar);
        // Verificar si la eliminacióactualización fue exitosa
        if ($resultado_actualizacion) {
            $respuesta_consulta = "<div class='mensaje-exitoso'>Empleado actualizado correctamente.</div>";
        } else {
            $respuesta_consulta = "<div class='mensaje-error'>No se pudo actualizar al empleado.</div>";
        }
    } elseif(isset($_POST['eliminar'])) {
        // Obtener el código del empleado a eliminar
        $codigo_eliminar = $_POST['codigo'];
        // Eliminar al empleado
        $resultado_eliminacion = $arbolEmpleados->eliminar($codigo_eliminar);
        // Verificar si la eliminación fue exitosa
        if (!$resultado_eliminacion) {
            $respuesta_consulta = "<div class='mensaje-exitoso'>Empleado eliminado correctamente.</div>";
        } else {
            $respuesta_consulta = "<div class='mensaje-error'>No se pudo eliminar al empleado.</div>";
        }
    }
}
?>