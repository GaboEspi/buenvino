<?php
session_start();
    //bool setcookie(string $name [, string $value [, int $expire [, string $path [, string $domain [, bool $secure [, bool $httponly]]]]]]) 

    $identficador = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 50);
    if(isset($_COOKIE['cliente'])){ 
        $_SESSION['cliente'] = $_COOKIE['cliente'];
    }else{ 
        setcookie('cliente', $identficador, time() + 365 * 24 * 60 * 60);  //caduca en un año
    }
 
    // echo substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 50); 
    //Método con str_shuffle() 
    
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/catalogo.css">
    <script >
        setTimeout(() => document.getElementById("mensaje").style.display = "none", 3000);
        function producto_agregado(){
        // alert("Producto agregado al carrito");
            document.getElementById("mensaje").style.display = "block";
        }
    </script>
    <link rel="icon" type="image/png" href="images/favicon.png">

    <title>Bodega BUENVINO | Catálogo</title>
</head>

<body <?php echo (isset($_GET['ok'])) ? "onload='producto_agregado()'":"" ; ?> >
    <header id="header">
        <h1>Bodega BUENVINO S.A.</h1>
    </header>
    <div id="mensaje">
        <h2>Producto agregado al carrito</h2>
    </div>
    <div id="contenedor">
        <div id="contenido">
            <aside>
                <ul>
                    <a href="index.php"><li>Inicio</li></a>
                    <a href="catalogo.php"><li>Productos</li></a>
                    <a href="carrito.php"><li>carrito</li></a>
                </ul>
            </aside>

            <div id="section">
                <!-- ++++ productos ++++ -->

                <!-- producto OFERTA -->
                <?php
                $conexion = mysqli_connect("localhost", "root", "", "buenvino") or die("ERROR: " . mysqli_error($conexion));
                $sql = "SELECT * FROM vinos WHERE oferta = 1";
                $resultados = mysqli_query($conexion, $sql);


                if (!empty($resultados)) {
                    while ($registro = mysqli_fetch_array($resultados)) {
                        if($registro['disponible'] == 1){
                            echo "<div class='producto oferta'>";
                            echo "<div class='imagen'><img src='images/vino-ico.png'></div>";
                            echo "<div class='detalles'>";
                            echo "<h4>".$registro['marca']."</h4>";
                            echo "<h2>$<span style='text-decoration:line-through'>  ".$registro['precio']." </span> --> <span style='color:green'>$ ".($registro['precio']/2)."</span> </h2>";
                            echo "<h4><span class='letra-peque'>Tipo: </span>" . $registro['tipo'] . " |<span class='letra-peque'> Clase: </span>" . $registro['clase'] . "</h4>";
                            echo "<h4><span class='letra-peque'>Origen: </span>" . $registro['origen'] . "</h4>";
                            echo "</div>";
                            echo "<div class='op-compra'>";

                            echo "<form action='agregar_carrito.php' method='post'>";                        
                            echo "<input type='number' name='cantidad' value='1' min='1' max='".$registro['cantidad']."'><br><br>";                        
                            echo "<input type='submit' value='Añadir a carrito'>";
                            echo "<input type='hidden' name='id' value='".$registro['id']."'>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                        }                        
                    }
                }
                ?>

                <!-- producto normales -->

                <?php

                $sql = "SELECT * FROM vinos";
                $resultados = mysqli_query($conexion, $sql);


                if (!empty($resultados)) {
                    while ($registro = mysqli_fetch_array($resultados)) {
                        if ($registro['oferta'] == 0 && $registro['disponible'] == 1) {
                            echo "<div class='producto'>";
                            echo "<div class='imagen'><img src='images/vino-ico.png'></div>";
                            echo "<div class='detalles'>";
                            echo "<h4>".$registro['marca']."</h4>";
                            echo "<h2>$ " . $registro['precio'] . "</h2>";
                            echo "<h4><span class='letra-peque'>Tipo: </span>" . $registro['tipo'] . " |<span class='letra-peque'> Clase: </span>" . $registro['clase'] . "</h4>";
                            echo "<h4><span class='letra-peque'>Origen: </span>" . $registro['origen'] . "</h4>";
                            echo "</div>";
                            echo "<div class='op-compra'>";

                            echo "<form action='agregar_carrito.php' method='post'>";                            
                            echo "<input type='number' name='cantidad' value='1' min='1' max='".$registro['cantidad']."'><br><br>";
                            echo "<input type='submit' value='Añadir a carrito'>";
                            echo "<input type='hidden' name='id' value='".$registro['id']."'>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                }

                // mysqli_free_result($resultado);
                // mysqli_close($conexion);
                ?>

                <!-- <div class="producto">
                    <div class="imagen"><img src="images/vino-ico.png" alt=""></div>
                    <div class="detalles">
                        <h4>Marca del producto</h4>
                        <h2>$ 736473</h2>
                        <h4><span>Tipo: </span> |<span> Clase: </span></h4>
                        <h4><span>Origen: </span>Origen</h4>
                    </div>
                    <div class="op-compra">
                        
                        <form action="add-carrito.php" method="post">
                            <input type="number" name="cantidad" value="1" min="1" max="10"><br><br>
                            <input type="submit" value="Añadir a carrito">
                        </form>
                    </div>
                </div>                 -->
            </div>
        </div>
    </div>

    <footer id="footer">
        <h3>© copyright · Todos los derechos reservados</h3>
        <h4>Universidad de Córdoba</h4>
    </footer>

    <?php
        // if($_GET['ok'] == 1){
        //     echo "agregado";
        //     echo "<script>alert('Producto agregado al carrito');</script>";
        // }
    ?>
</body>

</html>