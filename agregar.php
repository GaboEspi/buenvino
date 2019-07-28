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
    <h1>Agregar nuevo producto</h1><br>
    <form action="agregar2.php" method="post">
        <table>
            <thead>
                <th>Disp.?</th>
                <th>Marca</th>
                <th>Tipo</th>
                <th>Clase</th>
                <th>Origen</th>
                <th>precio</th>
                <th>cant.</th>
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox" name="disponible" value="1" checked></td>
                    <td><input type="text" name="marca"></td>
                    <td><select name="tipo">
                        <option value="blanco">blanco</option>
                        <option value="tinto">tinto</option>
                        <option value="rosado">rosado</option>
                    </select></td>
                    <td><select name="clase" >
                        <option value="joven">joven</option>
                        <option value="crianza">crianza</option>
                        <option value="reserva">reserva</option>
                    </select></td>
                    <td><input type="text" name="origen"></td>
                    <td><input type="number" name="precio"></td>
                    <td><input type="number" name="cantidad"></td>             
                </tr>                
            </tbody>
        </table><br>
        <input type="submit" value="Guardar">
    </form>
</body>

</html>