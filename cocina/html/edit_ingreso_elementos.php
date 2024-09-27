<?php
include("connection.php");
$con = connection();

if (isset($_POST['id']) && isset($_POST['elemento']) && isset($_POST['cantidad']) && isset($_POST['fecha']) && isset($_POST['ubicacion']) && isset($_POST['afectada'])) {
    $id = $_POST['id'];
    $elemento = $_POST['elemento'];
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['fecha'];
    $ubicacion = $_POST['ubicacion'];
    $afectada = $_POST['afectada'];

    // Sanitización de entradas para prevenir inyección SQL
    $id = mysqli_real_escape_string($con, $id);
    $elemento = mysqli_real_escape_string($con, $elemento);
    $cantidad = mysqli_real_escape_string($con, $cantidad);
    $fecha = mysqli_real_escape_string($con, $fecha);
    $ubicacion = mysqli_real_escape_string($con, $ubicacion);
    $afectada = mysqli_real_escape_string($con, $afectada);


    $sql = "UPDATE ingreso_elementos SET elemento='$elemento', cantidad='$cantidad', fecha='$fecha', ubicacion='$ubicacion', afectada='$afectada' WHERE id='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header("Location: ingreso_elementos.php");
    } else {
        echo "Error al actualizar el registro";
    }
}
?>
