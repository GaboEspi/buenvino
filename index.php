<?php
    session_start();
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/inicio.css">
    <script src="js/inicio.js"></script>
    <link rel="icon" type="image/png" href="images/favicon.png">

    <title>Bodega BUENVINO</title>
</head>
<body>
    <header id="header"><h1>Bodega BUENVINO S.A.</h1></header>
    <div id="contenedor">
        <a href="catalogo.php">
            <div id="cliente">
                <img src="images/logo-banner.png" alt="logo buenvino">
                <p>Soy un cliente</p>
                <p>DESEO COMPRAR</p>
            </div>
        </a>
        <?php            
            if(isset($_SESSION['login']) && $_SESSION['login'] == 'admin'){
                echo "<a href='administrador.php'>";
            }else{
                echo "<a href='#'  onclick='activar_pass()'>";
            }
        ?>
        <!-- <a href="#"  onclick="activar_pass()"> -->
            <div id="admin"><h3>Ingresar como administrador</h3></div>
        </a>
    </div>

    <div id="validar-admin">
        <div id="ventana-pass">
            <h2>Ingrese contraseña de administrador</h2><br>
            <form action="validar.php" method="post">
                <input type="password" name="pass" placeholder="Contraseña" id="pass" autofocus><br>
                <input type="button" value="Cancelar" class="boton" onclick="cancelar()">
                <input type="submit" value="Ingresar" class="boton">
            </form>
        </div>
    </div><br><br>
    <footer id="footer">
        <h3>© copyright · Todos los derechos reservados</h3>
        <h4>Universidad de Córdoba</h4>
    </footer>
    
    <?php 
        //codigo PHP
    ?>
</body>
</html>