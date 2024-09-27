<?php
include("connection.php");
$con = connection();

if (isset($_POST['id']) && isset($_POST['elemento']) && isset($_POST['tipo_elemeto']) && isset($_POST['clase']) && isset($_POST['inventario'])) {
    $id = $_POST['id'];
    $elementos = $_POST['elementos'];
    $tipo_elemento = $_POST['tipo_elemento'];
    $clase = $_POST['clase'];
    $inventario = $_POST['inventario'];

    // Sanitización de entradas para prevenir inyección SQL
    $id = mysqli_real_escape_string($con, $id);
    $nombre = mysqli_real_escape_string($con, $nombre);
    $curso = mysqli_real_escape_string($con, $curso);
    $activo = mysqli_real_escape_string($con, $activo);


    $sql = "UPDATE elementos SET elementos='$elementos', tipo_elemento='$tipo_elemento', clase='$clase', inventario='$inventario' WHERE id='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header("Location: elementos.php");
    } else {
        echo "Error al actualizar el registro";
    }
}
?>
