<?php
session_start();
// error_reporting(0);
if (!isset($_SESSION['login'])) {
    echo "Acceso denegado!";
    header("location:index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="images/favicon.png">

    <style>
        [type=checkbox]{
            /* width: 120px; */
            transform-origin: 20% 20%;
            transform: scale(1.8);
            margin-left: 10px;
        }
    </style>
    <title>Bodega BUENVINO | Editar</title>
</head>

<body style="padding: 40px">
    <?php
    if (!empty($_GET["id"])) {
        $conexion = mysqli_connect("localhost", "root", "", "buenvino") or die("ERROR: " . mysql_error($conexion));
        $sql = "SELECT * FROM vinos WHERE id = " . $_GET["id"];
        $resultado = mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));
        if ($resultado) {
            $registro = mysqli_fetch_array($resultado);
        }
    }
    ?>
    <form action="editar_vino2.php" method="post">
        <table>
            <thead>
                <th>Disp.?</th>
                <th>Marca</th>
                <th>Tipo</th>
                <th>Clase</th>
                <th>Origen</th>
                <th>precio</th>
                <th>oferta.?</th>
                <th>cant.</th>
            </thead>
            <tbody>
                <tr>
                <input type="hidden" name="id" value="<?php echo $registro["id"];  ?>">
                    <td><input type="checkbox" name="disponible" value="1" <?php echo ($registro['disponible']>0)?"checked":"";?>></td>
                    <td><input type="text" name="marca" value="<?php echo $registro["marca"]; ?>"></td>
                    <td><select name="tipo" id="">
                        <option <?php if($registro['tipo'] == 'blanco'){echo "selected";}?> value="blanco">blanco</option>
                        <option <?php if($registro['tipo'] == 'tinto'){echo "selected";}?> value="tinto">tinto</option>
                        <option <?php if($registro['tipo'] == 'rosado'){echo "selected";}?> value="rosado">rosado</option>
                    </select></td>
                    <td><select name="clase" id="">
                        <option <?php if($registro['clase'] == 'joven'){echo "selected";}?> value="joven">joven</option>
                        <option <?php if($registro['clase'] == 'crianza'){echo "selected";}?> value="crianza">crianza</option>
                        <option <?php if($registro['clase'] == 'reserva'){echo "selected";}?> value="reserva">reserva</option>
                    </select></td>
                    <td><input type="text" name="origen" value="<?php echo $registro["origen"]; ?>"></td>
                    <td><input type="number" name="precio" value="<?php echo $registro["precio"]; ?>"></td>
                    <td><input type="checkbox" name="oferta" value="1" <?php echo ($registro['oferta']>0)?"checked":"";?>></td>
                    <td><input type="number" name="cantidad" value="<?php echo $registro["cantidad"]; ?>"></td>             
                </tr>                
            </tbody>
        </table><br>
        <input type="submit" value="Guardar">
    </form>
</body>

</html>