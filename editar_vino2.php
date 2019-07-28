<?php
        
        session_start();
        // error_reporting(0);
        if (!isset($_SESSION['login'])) {
            echo "Acceso denegado!";
            header("location:index.php");
            die();
        }
        
        $conexion = mysqli_connect("localhost", "root", "", "buenvino") or die("ERROR: ".mysqli_error($conexion));
        
        $disponible = (isset($_POST["disponible"]) && $_POST["disponible"] == 1) ? 1 : 0;
        $oferta = (isset($_POST["oferta"]) && $_POST["oferta"] == 1) ? 1 : 0;
        
        $sql = "SELECT oferta FROM vinos WHERE id = ".$_POST['id'];
        $resultados = mysqli_query($conexion, $sql) or die("ERROR: ".mysqli_error($conexion));
        $registro = mysqli_fetch_array($resultados);
        if($registro['oferta'] != $oferta){
            $sql = "UPDATE vinos SET oferta = 0 WHERE oferta = 1";
            $resultados = mysqli_query($conexion, $sql) or die("ERROR: ".mysqli_error($conexion));            
        }

        $sql = "UPDATE vinos SET 
        disponible = ".$disponible.", 
        marca = '".$_POST["marca"]."', 
        tipo = '".$_POST["tipo"]."', 
        clase = '".$_POST["clase"]."', 
        origen = '".$_POST["origen"]."',  
        precio = ".$_POST["precio"].", 
        oferta = ".$oferta.", 
        cantidad = ".$_POST["cantidad"]." 
        WHERE id = ".$_POST['id'];
        
		mysqli_query($conexion, $sql) or die("ERROR: ".mysqli_error($conexion));	

		header("Location:administrador.php");

?>

