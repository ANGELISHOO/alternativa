<?php
include("connection.php");
$con = connection();

if (isset($_POST['id_usuario']) && isset($_POST['nombre_usuario']) && isset($_POST['usuario']) && isset($_POST['pass']) && isset($_POST['nivel_seguridad'])) {
    $id_usuario = $_POST['id_usuario'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    $nivel_seguridad = $_POST['nivel_seguridad'];

    // Sanitización de entradas para prevenir inyección SQL
    $id_usuario = mysqli_real_escape_string($con, $id_usuario);
    $nombre_usuario = mysqli_real_escape_string($con, $nombre_usuario);
    $usuario = mysqli_real_escape_string($con, $usuario);
    $nivel_seguridad = mysqli_real_escape_string($con, $nivel_seguridad);

    // Encriptar la contraseña antes de guardarla
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios SET nombre_usuario='$nombre_usuario', usuario='$usuario', pass='$hashed_password', nivel_seguridad='$nivel_seguridad' WHERE id_usuario='$id_usuario'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header("Location: crud_usuarios.php");
    } else {
        echo "Error al actualizar el registro";
    }
}
?>
