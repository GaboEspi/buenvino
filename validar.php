<?php
$pass=$_POST['pass'];

// $conexion=mysqli_connect("localhost", "root", "", "buenvino");
// $sql="SELECT * FROM usuarios where user = 'admin' and pass='$pass'";
// $resultado=mysqli_query($conexion, $sql);
// $filas=mysqli_num_rows($resultado);
// if($filas>0){    
//     session_start();
//     $_SESSION['user'] = 'admin';
//     header("location:administrador.php");
// }else {
//     echo "error de validacion";
// }

session_start();
if($pass == 1234){    
    
    $_SESSION['login'] = 'admin';
    header("location:administrador.php");
}else {
    echo "error de validacion <br><br>";
    echo "Redirigir a <a href='index.php'>Inicio</a> en 2 segundos..";
    echo "<script> function redirecciona() {
        location.href='index.php';
      }      
      setTimeout('redirecciona()', 3000);
      
      </script>";
}

// mysqli_free_result($resultado);
// mysqli_close($conexion);
?>