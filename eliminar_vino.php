<?php
    
	session_start();
	// error_reporting(0);
	if (!isset($_SESSION['login'])) {
		echo "Acceso denegado!";
		header("location:index.php");
		die();
	}
	
	if(!empty($_GET["id"])){
		// $conexion = mysqli_connect("localhost", "root", "", "buenvino") or die("ERROR: ".mysqli_error($conexion));
		require("conexion.php");
		$sql = "DELETE FROM vinos WHERE id = ".$_GET["id"];
        mysqli_query($conexion, $sql) or die("ERROR: ".mysqli_error($conexion));	
	}
	header("Location:administrador.php");
	exit;
?>