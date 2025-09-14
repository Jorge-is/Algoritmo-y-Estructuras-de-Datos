<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $buscar = $_POST['buscar'];
        $lista = $_POST['lista'];
        $_COOKIE['buscar'] = $buscar;
        $_COOKIE['lista'] = $lista;

        $array = explode("-", $_COOKIE['lista']);
        function busqBinaria($array, $elemento) {
            $inf = 0; 
            $sup = count($array) - 1;
            while ($inf <= $sup) { 
                $medio = floor(($inf + $sup) / 2);
    
                if ($array[$medio] == $elemento) { 
                    return $medio; 
                }
                if ($array[$medio] < $elemento) { 
                    $inf = $medio + 1; 
                } else { 
                    $sup = $medio - 1;       
                }
            }
            return -1;
        }
        $indice = busqBinaria($array, $_COOKIE['buscar']);
    }
?>

<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda Binaria</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
    <?php require_once './fragments/header.php'; ?>
    <div class="titulo">
        <h2><strong>BUSQUEDA DE NÚMERO</strong></h2>
    </div>
    <div class="contenedor">
        <div class="datos">
            <form id="reset" method="POST" action="intranet1.php">
                <table>
                    <tr>
                        <td>
                            <label class="texto-blanco">Lista</label>
                        </td>
                        <td>
                            <input id="array" class="espacio caja-texto" type="text" name="lista" placeholder="Ingrese el arreglo o la lista" 
                            value ="<?php if(isset($_COOKIE['lista'])){
                                echo $_COOKIE['lista'];
                            }else{
                                echo "";
                            } ?>"><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="texto-blanco">Buscar</label>
                        </td>
                        <td>
                            <input id="buscar" class="espacio caja-texto" type="text" name="buscar" placeholder="Ingrese el número a buscar" 
                            value ="<?php if(isset($_COOKIE['buscar'])){
                                echo $_COOKIE['buscar'];
                            }else{
                                echo "";
                            } ?>">
                        </td>
                    </tr>
                </table>
                <div class="espacio botones">
                    <input class="boton1" type="submit" value="BUSCAR">
                    <input class="boton1" type="button" value="LIMPIAR" onclick="boton_limpiar()">
                    <a class="boton1" href="pdf.php?lista=<?php echo $lista;?>&buscar=<?php echo $buscar;?>&indice=<?php echo $indice;?>" target="_blanck"><img src="imagenes/pdf.png" alt="Logo PDF" width="30px" heigth="30px"></a>
                </div>
            </form>
        </div>

        <div class="espacio">
                <div id="imprimir" class="caja-mensaje" name="mensaje" cols="48" rows="10"><?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($indice)): ?><?php 
                if ($indice != -1): ?>Lista de números: <?php echo $lista."<br>";?>
                El número <?php echo $buscar; ?> se encuentra en el índice <?php echo $indice; ?> del arreglo.
                <?php else: ?>
                    El número <?php echo $buscar; ?> no se encuentra en el arreglo.
                <?php endif; ?>
            <?php endif; ?>
                </div>
        </div>
    </div>
    <script>
        function boton_limpiar() {
            document.getElementById("array").value="";
            document.getElementById("buscar").value="";
            let mostrar = document.getElementById("imprimir");
            mostrar.innerHTML="";
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>