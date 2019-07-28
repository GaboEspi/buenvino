<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['login'])) {
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/administrador.css">
    <script src="js/administrador.js"></script>
    <link rel="icon" type="image/png" href="images/favicon.png">

    <title>Bodega BUENVINO | Administrador</title>
</head>

<body>
    <header id="header">
        <h1>Bodega BUENVINO S.A.</h1>
    </header>
    <div id="contenedor">
        <a href="cerrar_sesion_admin.php">Cerrar sesion.</a>
        <h1>Administrador</h1>
        <div id="contenido">
            <aside>
                <ul>
                    <a href="index.php"><li>Inicio</li></a>
                    <a href="#" onclick="cambio_ventana('productos')">
                        <li>Productos</li>
                    </a>
                    <a href="#" onclick="cambio_ventana('informes')">
                        <li>Informes</li>
                    </a>
                    <a href="#" onclick="cambio_ventana('configuracion')">
                        <li>Configuracion</li>
                    </a>
                </ul>
            </aside>
            <div id="section">
                <div id="productos">
                    <table>
                        <thead>
                            <th>Disp.?</th>
                            <th>Marca</th>
                            <th>Tipo</th>
                            <th>Clase</th>
                            <th>Origen</th>
                            <th>precio</th>
                            <th>oferta.?</th>
                            <th>cant.</th>
                            <th>editar</th>
                        </thead>
                        <tbody>
                            <?php
                            $conexion = mysqli_connect("localhost", "root", "", "buenvino") or die("ERROR: " . mysqli_error($conexion));
                            $sql = "SELECT * FROM vinos";
                            $resultados = mysqli_query($conexion, $sql) or die("ERROR: " . mysqli_error($conexion));
                            if (empty($resultados)) {
                                echo '<tr><td colspan="5"></td></tr>';
                            } else {
                                // $i = 0;
                                while ($registro = mysqli_fetch_array($resultados)) {
                                    // $i++;
                                    echo '<tr>';
                                    if ($registro["disponible"] == 0) {
                                        echo '<td style="color:red">Oculto</td>';
                                    } else {
                                        echo '<td style="color:green">Disp.</td>';
                                    }
                                    // echo '<td>'.$registro["disponible"].'</td>';
                                    echo '<td>' . $registro["marca"] . '</td>';
                                    echo '<td>' . $registro["tipo"] . '</td>';
                                    echo '<td>' . $registro["clase"] . '</td>';
                                    echo '<td>' . $registro["origen"] . '</td>';
                                    echo '<td>' . $registro["precio"] . '</td>';
                                    if ($registro["oferta"] == 0) {
                                        echo '<td>No</td>';
                                    } else {
                                        echo '<td style="background-color:yellow">En OFERTA</td>';
                                    }
                                    // echo '<td>'.$registro["oferta"].'</td>';
                                    echo '<td>' . $registro["cantidad"] . '</td>';
                                    echo '<td>
										<a onclick="javascript: return confirm(\'Desea eliminar el registro actual?\')" href="eliminar_vino.php?id=' . $registro["id"] . '">Eliminar</a>
										<a href="editar_vino.php?id=' . $registro["id"] . '">Editar</a>
								      </td>';
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </tbody>

                    </table>
                    <a href="agregar.php">Agregar producto</a>

                </div>
                <div id="informes" style="display: none">Informes
                    
                </div>
                <!-- <div id="configuracion" style="display: none">configuracion</div> -->
            </div>

        </div>

    </div>

    <footer id="footer">
        <h3>© copyright · Todos los derechos reservados</h3>
        <h4>Universidad de Córdoba</h4>
    </footer>

    <?php
    //codigo PHP
    ?>
</body>

</html>