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
                            value="<?php echo $respuesta_codigo; ?>" required>
                        <label>NOMBRES</label>
                        <input type="text" name="nombre" placeholder="Ingrese el nombre"
                            value="<?php echo $respuesta_nombre; ?>">
                        <label>APELLIDOS</label>
                        <input type="text" name="apellido" placeholder="Ingrese el apellido"
                            value="<?php echo $respuesta_apellido; ?>">
                        <label>TIPO DE CONTRATO</label>
                        <select name="tipoContrato">
                            <option value="Plazo Fijo" <?php if($respuesta_tipoContrato=="Plazo Fijo" ) echo "selected"
                                ; ?>>Plazo Fijo</option>
                            <option value="Servicios No Personales" <?php
                                if($respuesta_tipoContrato=="Servicios No Personales" ) echo "selected" ; ?>>Servicios
                                No Personales</option>
                            <option value="Service" <?php if($respuesta_tipoContrato=="Service" ) echo "selected" ; ?>
                                >Service</option>
                        </select>
                        <label>SUELDO</label>
                        <input type="text" name="sueldo" placeholder="Digite el sueldo"
                            value="<?php echo $respuesta_sueldo; ?>">
                    </fieldset>
                    <div class="contenedor-botones">
                        <input id="boton-guardar" class="boton" type="submit" name="guardar" value="GUARDAR">
                        <input class="boton" type="submit" name="consultar" value="CONSULTAR">
                        <input class="boton" type="submit" name="actualizar" value="ACTUALIZAR">
                        <input class="boton" type="submit" name="eliminar" value="ELIMINAR">
                        <a class="boton" href="pdf.php" target = "_blanck"><img src="imagenes/pdf.png" alt="Imagen de logo PDF" width = "30px" heigth = "30px"></a>
                        <a class="boton" href="excel.php"><img src="imagenes/excel.png" alt="Imagen de logo Excel" width = "30px" heigth = "30px"></a>
                    </div>
                </form>
            </div>
        </div>
        <div class="contenedor2" cols="50" rows="50">
            <table class="tabla-empleados">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Tipo de Contrato</th>
                        <th>Sueldo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if (isset($listaEmpleados)) {
                            $listaEmpleados->mostrarEmpleados();
                        } else {
                            echo "<tr><td colspan='6'>No hay empleados registrados.</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>