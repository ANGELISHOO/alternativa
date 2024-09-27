<?php
include("connection.php");
$con = connection();

$id_usuario = $_POST['id_usuario'];
$nombre_usuario = $_POST['nombre_usuario'];
$usuario = $_POST['usuario'];
$pass = $_POST['pass'];
$nivel_seguridad = $_POST['nivel_seguridad'];

$contrasena_encriptada = password_hash($pass, PASSWORD_DEFAULT);

// Asegúrate de que los nombres de los campos coincidan con los de la base de datos
$sql = "INSERT INTO Usuarios (id_usuario, nombre_usuario, usuario, pass, nivel_seguridad) 
        VALUES('$id_usuario', '$nombre_usuario', '$usuario', '$contrasena_encriptada', $nivel_seguridad)";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: usuarios.php");
} else {
    echo "Error al insertar usuario: " . mysqli_error($con);
}

// Cerrar conexión
mysqli_close($con);
?>
