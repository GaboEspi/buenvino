<?php
    session_start();
    //bool setcookie(string $name [, string $value [, int $expire [, string $path [, string $domain [, bool $secure [, bool $httponly]]]]]]) 

    $identficador = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 50);
    if(!isset($_COOKIE['cliente'])){
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
    <link rel="stylesheet" href="css/pagar_datos.css">
    <link rel="icon" type="image/png" href="images/favicon.png">
    
    <title>Bodega BUENVINO | ingresar datos de cliente</title>
</head>
<body>
    <div class="contenedor">
        <h2>Total a pagar: <?php echo ($_POST['subtotal']*1.19); ?></h2>
        <form action="pagar_validacion.php" method="post">
            <input type="text" name="nombre" placeholder="nombre y apellidos" required><br>
            <input type="email" name="email" placeholder="e-mail" required><br>
            <input type="text" name="direccion" placeholder="Dirección" required><br>
            <input type="text" name="credito" placeholder="Numero de tarjeta credito" required><br>
            <input type="tel" name="telefono" placeholder="telefono" required><br>
            <input type="hidden" name="subtotal" value="<?php echo $_POST['subtotal']; ?>">
            <input type="submit" value="Continuar">
        </form>
    </div>
</body>
</html>