<?php
$cliente = $_COOKIE["cliente"];

$conexion = mysqli_connect("localhost", "root", "", "buenvino") or die("ERROR: ".mysqli_error($conexion));
$sql = "SELECT * FROM carrito WHERE (id_vino = " . $_POST['id'] . " AND cliente = '" . $cliente . "')";
$resultados = mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));

if (!empty($resultados)) { 
    $registro = mysqli_fetch_array($resultados);
    if (isset($registro)) {//si existe un registro
        $cantidad = $registro['cantidad'] + $_POST['cantidad'];
        $sql = "UPDATE carrito SET cantidad  = " . $cantidad . " WHERE id = " . $registro['id'];
        $resultados = mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));
    } else {
        $sql = "INSERT INTO carrito (id, cliente, id_vino, cantidad) VALUES ('', '" . $cliente . "', " . $_POST['id'] . ", " . $_POST['cantidad'] . ")";
        mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));
    }
} 
header("location:catalogo.php?ok");

// echo "<h2>Producto agregado al carrito correctamente</h2><br>";
// echo "<br><br><a href='catalogo.php'>Ir a catalogo</a>";
    // mysqli_free_result($registro);
    // mysqli_close($conexion);


?>
