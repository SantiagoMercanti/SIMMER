<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Validar que los campos no estén vacíos
    if (!empty($nombre) && !empty($apellido) && !empty($correo) && !empty($usuario) && !empty($password)) {
        // Encriptar contraseña para mayor seguridad
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insertar datos en la base de datos
        $sql = "INSERT INTO usuarios (nombre, apellido, correo, usuario, password, id_nivel) 
                VALUES ('$nombre', '$apellido', '$correo', '$usuario', '$password_hash', 2)"; // Asigna el nivel 2 por defecto

        if (mysqli_query($conexion, $sql)) {
            /*echo "<h1>Registro exitoso. Ahora puedes iniciar sesión.</h1>";
            echo "<a href='index.html'>Volver al Login</a>";*/
             // Redirigir con el mensaje de éxito
            header("Location: index.html?registro=exitoso");
        } else {
            echo "Error al registrar usuario: " . mysqli_error($conexion);
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }

    // Cerrar conexión
    mysqli_close($conexion);
} else {
    echo "Método no permitido.";
}
?>
