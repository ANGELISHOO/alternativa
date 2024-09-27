<?php
include("connection.php");
$con = connection();

if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['curso']) && isset($_POST['activo'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $curso = $_POST['curso'];
    $activo = $_POST['activo'];

    // Sanitización de entradas para prevenir inyección SQL
    $id = mysqli_real_escape_string($con, $id);
    $nombre = mysqli_real_escape_string($con, $nombre);
    $curso = mysqli_real_escape_string($con, $curso);
    $activo = mysqli_real_escape_string($con, $activo);


    $sql = "UPDATE docentes SET nombre='$nombre', curso='$curso', activo='$activo' WHERE id='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header("Location: docente.php");
    } else {
        echo "Error al actualizar el registro";
    }
}
?>
