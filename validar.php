<?php

include("db.php");

$USUARIO = $_POST['usuario'];
$PASSWORD = $_POST['password'];

session_start();
$_SESSION['usuario'] = $USUARIO;

$conexion=mysqli_connect("localhost","root","","rol");

$consulta = "SELECT * FROM usuarios WHERE usuario='$USUARIO' and password='$PASSWORD'";
$resultado = mysqli_query($conexion, $consulta);

$filas = mysqli_fetch_array($resultado);

if($filas['id_nivel']==1){ //admin
    header("location:home.html"); //aca debería mandarme a una pagina que va a tener todos los accesos
}else if($filas['id_nivel']==2){ //estandar
    header("location:home.html"); //aca debería mandarme a una pagina igual a la anterior que va a tener menos accesos
}
else{
    include("index.html");
    ?>
    <h1>ERROR EN LA AUTENTIFICACION</h1>
    <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);

?>