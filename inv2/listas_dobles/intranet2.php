<?php 
    include_once('clases/Main.php');
?>

<!DOCTYPE html>
<html lang="ES">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO DE EMPLEADOS</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body>
    <?php require_once 'fragments/header.php'; ?>
    <div class="contenedor-general">
        <div class="contenedor1">
            <div class="titulo-registro">
                <h2>REGISTRO DE EMPLEADOS</h2>
            </div>
            <div class="contenedor-mensaje">
                <?php echo $respuesta_consulta; ?>
            </div>
            <div class="contenedor-datos">
                <form method="POST" action="intranet2.php">
                    <fieldset>
                        <legend>Datos del empleado</legend>
                        <label>CÓDIGO</label>
                        <input type="text" name="codigo" placeholder="Ingrese el código"
                            value="<?php echo $respuesta_codigo; ?>">
                        <label>NOMBRE</label>
                        <input type="text" name="nombre" placeholder="Ingrese el nombre"
                            value="<?php echo $respuesta_nombre; ?>">
                        <label>APELLIDOS</label>
                        <input type="text" name="apellido" placeholder="Ingrese el apellido"
                            value="<?php echo $respuesta_apellido; ?>">
                        <label>SEXO</label>
                        <select name="sexo">
                            <option value="Masculino" <?php if ($respuesta_sexo=="Masculino" ) echo "selected" ; ?>
                                >Masculino</option>
                            <option value="Femenino" <?php if($respuesta_sexo=="Femenino" ) echo "selected" ; ?>
                                >Femenino</option>
                        </select>
                        <label>SUELDO</label>
                        <input type="text" name="sueldo" placeholder="Digite el sueldo"
                            value="<?php echo $respuesta_sueldo; ?>">
                    </fieldset>
                    <div class="contenedor-botones">
                        <input id="boton-guardar" class="boton" type="submit" name="guardar" value="GUARDAR">
                        <input class="boton" type="submit" name="consultar" value="CONSULTAR">
                        <input class="boton" type="submit" name="actualizar" value="ACTUALIZAR">
                        <input class="boton" type="submit" name="adelante_atras" value="ADELANTE - ATRÁS">
                        <input class="boton" type="submit" name="atras_adelante" value="ATRÁS - ADELANTE">
                        <input class="boton" type="submit" name="eliminar" value="ELIMINAR">
                    </div>
                </form>
            </div>
        </div>
        <div class="contenedor-tabla" cols="50" rows="50">
            <table class="tabla-empleados">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Sexo</th>
                        <th>Sueldo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if (isset($listaEmpleados)) {
                            if (isset($_SESSION['mostrar_adelante']) && $_SESSION['mostrar_adelante']) {
                                $listaEmpleados->mostrarEmpleadosAtras();
                            } else {
                                $listaEmpleados->mostrarEmpleadosAdelante();
                            }
                        } else {
                            echo "<tr><td colspan='5'>No hay empleados registrados.</td></tr>";
                        }                                                
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>