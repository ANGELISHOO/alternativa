<?php
include("connection.php");
$con = connection();

if (isset($_POST['id']) && isset($_POST['elemento']) && isset($_POST['baja']) && isset($_POST['fecha']) && isset($_POST['afectada']) && isset($_POST['descripcion'])) {
    $id = $_POST['id'];
    $elemento = $_POST['elemento'];
    $baja = $_POST['baja'];
    $fecha = $_POST['fecha'];
    $afectada = $_POST['afectada'];
    $descripcion = $_POST['descripcion'];

    $id = mysqli_real_escape_string($con, $id);
    $elemento = mysqli_real_escape_string($con, $elemento);
    $baja = mysqli_real_escape_string($con, $baja);
    $fecha = mysqli_real_escape_string($con, $fecha);
    $afectada = mysqli_real_escape_string($con, $afectada);
    $descripcion = mysqli_real_escape_string($con, $descripcion);


    $sql = "UPDATE traspaso SET elemento='$elemento', baja='$baja', fecha='$fecha', afectada='$afectada', descripcion='$descripcion' WHERE id='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header("Location: traspaso.php");
    } else {
        echo "Error al actualizar el registro";
    }
}
?>
