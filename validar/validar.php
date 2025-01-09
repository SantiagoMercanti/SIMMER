<?php

include("db.php");

$USUARIO = $_POST['usuario'];
$PASSWORD = $_POST['password'];

session_start();
$_SESSION['usuario'] = $USUARIO;

$conexion = mysqli_connect("localhost", "root", "", "rol");

// Consulta para obtener el hash de la contraseña del usuario
$consulta = "SELECT * FROM usuarios WHERE usuario='$USUARIO'";
$resultado = mysqli_query($conexion, $consulta);

if ($filas = mysqli_fetch_array($resultado)) {
    // Verificar la contraseña ingresada con el hash almacenado
    if (password_verify($PASSWORD, $filas['password'])) {
        // Verificar el nivel del usuario
        if ($filas['id_nivel'] == 1) { // Admin
            header("location:home.html"); // Página con todos los accesos
        } else if ($filas['id_nivel'] == 2) { // Usuario estándar
            header("location:home.html"); // Página con accesos limitados
        }
    } else {
        /*include("index.html");
        echo "<h1>Contraseña incorrecta</h1>";*/
        // Contraseña incorrecta, redirigir con mensaje de error
        header("Location: index.html?error=contraseña");
    }
} else {
    /* Usuario no encontrado
    include("index.html");
    echo "<h1>Usuario inexistente</h1>";*/
    // Usuario no encontrado, redirigir con mensaje de error
    header("Location: index.html?error=usuario");
}

mysqli_free_result($resultado);
mysqli_close($conexion);

?>
