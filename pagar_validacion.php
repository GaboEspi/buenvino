<?php

    session_start();
    //bool setcookie(string $name [, string $value [, int $expire [, string $path [, string $domain [, bool $secure [, bool $httponly]]]]]]) 

    $identficador = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 50);
    if(!isset($_COOKIE['cliente'])){
        header("location:index.php");
        die();
    }


    $conexion = mysqli_connect("localhost", "root", "", "buenvino") or die("ERROR: " . mysqli_error($conexion));
    $sql = "INSERT INTO clientes (nombre, telefono, direccion, correo) VALUES ('".$_POST['nombre']."', '".$_POST['telefono']."', '".$_POST['direccion']."', '".$_POST['email']."')";//insertar registro en cliente
    mysqli_query($conexion, $sql);
    $id_cliente = mysqli_insert_id($conexion);

    $sql = "SELECT * FROM carrito WHERE id = '".$_COOKIE['cliente']."'";
    $resultados = mysqli_query($conexion, $sql);
    while($registro = mysqli_fetch_array($resultados)){

    }


    $sql = "INSERT INTO facturas (id_cliente, subtotal, iva, total) VALUES ('".$id_cliente."', '".$_POST['subtotal']."', '".($_POST['subtotal']*0.19)."', '".($_POST['subtotal']*1.19)."')";// registro en facturas
    // id_cliente	subtotal	iva	total
    mysqli_query($conexion, $sql);

    $id_factura = mysqli_insert_id($conexion);

    $sql = "SELECT * FROM carrito WHERE cliente = '".$_COOKIE['cliente']."'";
    $resultados = mysqli_query($conexion, $sql);
    if(isset($resultados)){
        while($registro = mysqli_fetch_array($resultados)){
            //por cada registro de cliente (cookies) en carrito, se debe realizar todas las operaciones para ese vino en particular, uno por uno
            $sql = "SELECT * FROM vinos WHERE id = ".$registro['id_vino'];
            $resultados_vinos = mysqli_query($conexion, $sql);
            $registro_vinos = mysqli_fetch_array($resultados_vinos);

            //id	venta_id	id_vino	precio	cantidad
            $precio = ($registro_vinos['oferta'] == 0) ? $registro_vinos['precio'] : ($registro_vinos['precio'] /2);
            $sql = "INSERT INTO venta_detalles (venta_id, id_vino, precio, cantidad) VALUES ('".$id_factura."', '".$registro['id_vino']."', '".$precio."', '".$registro['cantidad']."')";
            mysqli_query($conexion, $sql);

            $sql = "UPDATE vinos SET cantidad = ".($registro_vinos['cantidad'] - $registro['cantidad']).", ventas = ".($registro_vinos['cantidad'] + $registro['cantidad'])." WHERE id =".$registro['id_vino'];
            mysqli_query($conexion, $sql);

        }
    }
    $sql = "DELETE FROM carrito WHERE cliente = '".$_COOKIE['cliente']."'";
    mysqli_query($conexion, $sql);
    setcookie('cliente','',time()-100);
    header('location:factura.php');
?>