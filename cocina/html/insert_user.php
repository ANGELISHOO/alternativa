<?php
include("connection.php");
$con = connection();

$id = $_POST['id'];
$nombre_usuario = $_POST['nombre_usuario'];
$usuario = $_POST['usuario'];
$pass = $_POST['pass'];
$rol = $_POST['rol'];
$id_nivel = $_POST['id_nivel'];

$contrasena_encriptada = password_hash($pass, PASSWORD_DEFAULT);

// Asegúrate de que los nombres de los campos coincidan con los de la base de datos
$sql = "INSERT INTO Usuarios (id, nombre_usuario, usuario, pass, rol, id_nivel) 
        VALUES('$id', '$nombre_usuario', '$usuario', '$contrasena_encriptada', '$rol', '$id_nivel')";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: crud_usuarios.php");
} else {
    echo "Error al insertar usuario: " . mysqli_error($con);
}

// Cerrar conexión
mysqli_close($con);
?>
