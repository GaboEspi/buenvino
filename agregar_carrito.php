<?php
$cliente=$_COOKIE["cliente"];
// $conexion = mysqli_connect("localhost", "root", "", "buenvino") or die("ERROR: ".mysqli_error($conexion));
require("conexion.php");
// echo $_POST['id']." id del vino<br>";
$sql="SELECT * FROM carrito WHERE (id_vino = ".$_POST['id']." AND cliente = '".$cliente."')";
$resultados=mysqli_query($conexion,$sql) or die("ERROR: ".mysqli_error($conexion));
if(!empty($resultados)){
    $registro=mysqli_fetch_array($resultados);
    if(isset($registro)){//si existe un registro
        $cantidad=$registro['cantidad']+$_POST['cantidad'];
        $sql="UPDATE carrito SET cantidad  = ".$cantidad." WHERE id = ".$registro['id'];
        $resultados=mysqli_query($conexion,$sql) or die("ERROR: ".mysqli_error($conexion));
    }else{
        $sql="INSERT INTO carrito (cliente, id_vino, cantidad) VALUES ('".$cliente."', ".$_POST['id'].", ".$_POST['cantidad'].")";
        mysqli_query($conexion,$sql) or die("ERROR: ".mysqli_error($conexion));
    }
}
header("location:catalogo.php?ok");
?>