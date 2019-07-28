<?php        
        session_start();
        // error_reporting(0);
        if (!isset($_SESSION['login'])) {
            // echo "Acceso denegado!";
            header("location:index.php");
            die();
        }        
        // $conexion = mysqli_connect("localhost", "root", "", "buenvino") or die("ERROR: ".mysqli_error($conexion));
        require("conexion.php");
        $disponible = (isset($_POST["disponible"]) && $_POST["disponible"] == 1) ? 1 : 0;
        $sql = "INSERT INTO vinos (disponible, marca, tipo, clase, origen, precio, cantidad) VALUES (".$disponible.", 
        '".$_POST['marca']."', 
        '".$_POST['tipo']."', 
        '".$_POST['clase']."', 
        '".$_POST['origen']."',  
        ".$_POST['precio'].", 
        ".$_POST['cantidad'].")";

		// echo $sql;
		mysqli_query($conexion, $sql) or die("ERROR: ".mysqli_error($conexion));	

		header("Location: administrador.php");