<?php
include("connection.php");
$con = connection();

if (isset($_POST['id']) && isset($_POST['elemento']) && isset($_POST['cantidad']) && isset($_POST['fecha']) && isset($_POST['afectada'])) {
    $id = $_POST['id'];
    $elemento = $_POST['elemento'];
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['fecha'];
    $afectada = $_POST['afectada'];

    // Sanitización de entradas para prevenir inyección SQL
    $id = mysqli_real_escape_string($con, $id);
    $elemento = mysqli_real_escape_string($con, $elemento);
    $cantidad = mysqli_real_escape_string($con, $cantidad);
    $fecha = mysqli_real_escape_string($con, $fecha);
    $afectada = mysqli_real_escape_string($con, $afectada);


    $sql = "UPDATE bajas SET elemento='$elemento', cantidad='$cantidad', fecha='$fecha', afectada='$afectada' WHERE id='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header("Location: bajas.php");
    } else {
        echo "Error al actualizar el registro";
    }
}
?>
