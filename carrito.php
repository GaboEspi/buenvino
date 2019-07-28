<?php
session_start();
    //bool setcookie(string $name [, string $value [, int $expire [, string $path [, string $domain [, bool $secure [, bool $httponly]]]]]]) 

    $identficador = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 50);
    if(!isset($_COOKIE['cliente'])){        
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
    <link rel="stylesheet" href="css/carrito.css">
    <script src="js/carrito.js"></script>
    <link rel="icon" type="image/png" href="images/favicon.png">

    <title>Bodega BUENVINO | Carrito</title>
</head>

<body>
    <header id="header">
        <h1>Bodega BUENVINO S.A.</h1>
    </header>
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
                $subtotal=0;

                $conexion = mysqli_connect("localhost", "root", "", "buenvino") or die("ERROR: " . mysqli_error($conexion));
                $sql = "SELECT * FROM carrito WHERE cliente = '".$_COOKIE['cliente']."'";
                $resultados = mysqli_query($conexion, $sql);
                
                
                if (!empty($resultados)) { 
                    echo "<h2>Carrito de compras</h2><br><br>";

                    //<!-- tabla mostrar carrito -->
                    echo "<table>";
                    echo"<thead>";
                        echo "<th>Marca</th>
                        <th>Precio unit.</th>
                        <th>Cantidad</th>                        
                        <th>Precio total</th>
                        <th></th>
                    </thead>
                    <tbody>";
                    while($registro = mysqli_fetch_array($resultados)){
                        
                            echo"<tr>";
                                

                                $sql_vinos1 =  "SELECT * FROM vinos WHERE id = ".$registro['id_vino'];
                                $resultados_vinos1 = mysqli_query($conexion, $sql_vinos1);
                                if(!empty($resultados_vinos1)){
                                    $registro1 = mysqli_fetch_array($resultados_vinos1);
                                    //marca
                                    echo"<td >".$registro1['marca']."</td>";
                                    //precio unitario
                                    if($registro1['oferta'] == 0){
                                        echo"<td >".$registro1['precio']."</td>";
                                    }else{
                                        echo"<td >".($registro1['precio']/2)."</td>";
                                    }
                                    //cantidad
                                    echo"<td >".$registro['cantidad']."</td>";
                                    // precio total
                                    if($registro1['oferta'] == 0){
                                        $subtotal+=($registro1['precio']*$registro['cantidad']);
                                        echo"<td >".($registro1['precio']*$registro['cantidad'])."</td>";
                                    }else{
                                        $subtotal+=(($registro1['precio']*$registro['cantidad'])/2);
                                        echo"<td >".(($registro1['precio']*$registro['cantidad'])/2)."</td>";
                                    }
                                }else{
                                    echo"<td >No disponible</td>";
                                    echo"<td >No disponible</td>";
                                    echo"<td >".$registro['cantidad']."</td>";
                                    echo"<td>no Disponible</td>";
                                }
                                
                                                                
                                echo"<td ><a href='eliminar_carrito.php?id_vino=\"".$registro['id_vino']."\"'>Eliminar Producto</a></td>";
                                echo"</tr>";
                            
                        
                    }
                    echo"<tr>";
                        echo "<td colspan='2'></td>";
                        echo"<td>Total a pagar</td>";
                        echo"<td>".$subtotal."</td>";
                        echo"<td></td>";
                    echo"</tr>";

                    echo"<tr>";
                        echo "<td colspan='2'></td>";
                        echo"<td>IVA</td>";
                        echo"<td>".($subtotal*0.19)."</td>";
                        echo"<td></td>";
                    echo"</tr>";

                    echo"<tr>";
                        echo "<td colspan='2'></td>";
                        echo"<td>Neto</td>";
                        echo"<td>".($subtotal*1.19)."</td>";
                        echo"<td></td>";
                    echo"</tr>";

                    echo"</tbody>";
                    echo "</table>";
                    echo "<br><br>";
                    
                    echo "<a href='#' onClick='enviar_form()'>Ir a pagar..</a>";

                    

                     echo' <form action="pagar_datos.php" id="subtotal_form" method="post">
                            <input type="hidden" name="subtotal" value="'.$subtotal.'">
                            
                        </form>';
                    
                }else{
                    echo "Su carrito está vacio";
                }
                ?>
            </div>
        </div>
    </div>

    <footer id="footer">
        <h3>© copyright · Todos los derechos reservados</h3>
        <h4>Universidad de Córdoba</h4>
    </footer>

    
</body>

</html>