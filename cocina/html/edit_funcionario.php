<?php
include("connection.php");
$con = connection();

if (isset($_POST['id']) && isset($_POST['funcionario']) && isset($_POST['activo'])) {
    $id = $_POST['id'];
    $funcionario = $_POST['funcionario'];
    $activo = $_POST['activo'];

    // Sanitización de entradas para prevenir inyección SQL
    $id = mysqli_real_escape_string($con, $id);
    $funcionario = mysqli_real_escape_string($con, $funcionario);
    $activo = mysqli_real_escape_string($con, $activo);


    $sql = "UPDATE funcionario SET funcionario='$funcionario', activo='$activo' WHERE id='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header("Location: funcionarios.php");
    } else {
        echo "Error al actualizar el registro";
    }
}
?>
