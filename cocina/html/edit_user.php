<?php
include("connection.php");
$con = connection();

if (isset($_POST['id']) && isset($_POST['nombre_usuario']) && isset($_POST['usuario']) && isset($_POST['pass']) && isset($_POST['rol']) && isset($_POST['id_nivel'])) {
    $id = $_POST['id'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    $rol = $_POST['rol'];
    $id_nivel = $_POST['id_nivel'];

    // Sanitización de entradas para prevenir inyección SQL
    $id = mysqli_real_escape_string($con, $id);
    $nombre_usuario = mysqli_real_escape_string($con, $nombre_usuario);
    $usuario = mysqli_real_escape_string($con, $usuario);
    $rol = mysqli_real_escape_string($con, $rol);
    $id_nivel = mysqli_real_escape_string($con, $id_nivel);
    $pass = mysqli_real_escape_string($con, $pass);

    // Encriptar la contraseña antes de guardarla
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios SET nombre_usuario='$nombre_usuario', usuario='$usuario', pass='$hashed_password', rol='$rol', id_nivel='$id_nivel' WHERE id='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header("Location: crud_usuarios.php");
    } else {
        echo "Error al actualizar el registro";
    }
}
?>
