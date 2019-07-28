<?php
    $id_vino = $_GET['id_vino'];
    // $conexion  = mysqli_connect("localhost", "root", "", "buenvino");
    require("conexion.php");
    $sql = "DELETE FROM carrito WHERE id_vino = ".$id_vino." AND cliente = '".$_COOKIE['cliente']."'";
    $resultados = mysqli_query($conexion, $sql);

    header("location:carrito.php");

?>