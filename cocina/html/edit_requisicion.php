<?php
include("connection.php");
$con = connection();

if (isset($_POST['id']) && isset($_POST['num_requisicion']) && isset($_POST['docente']) && isset($_POST['fecha_solicitud']) && isset($_POST['fecha_solicitud']) && isset($_POST['fecha_de_entrega']) && isset($_POST['grupo_encargado']) && isset($_POST['funcionario']) && isset($_POST['evento']) && isset($_POST['observaciones']) && isset($_POST['anulada'])) {
    $id = $_POST['id'];
    $num_requisicion = $_POST['num_requisicion'];
    $docente = $_POST['docente'];
    $fecha_solicitud = $_POST['fecha_solicitud'];
    $fecha_de_entrega = $_POST['fecha_de_entrega'];
    $grupo_encargado = $_POST['grupo_encargado'];
    $funcionario = $_POST['funcionario'];
    $evento = $_POST['evento'];
    $observaciones = $_POST['observaciones'];
    $anulada = $_POST['anulada'];
    // Sanitización de entradas para prevenir inyección SQL
    $id = mysqli_real_escape_string($con, $id);
    $num_requisicion = mysqli_real_escape_string($con, $num_requisicion);
    $docente = mysqli_real_escape_string($con, $docente);
    $fecha_solicitud = mysqli_real_escape_string($con, $fecha_solicitud);
    $fecha_de_entrega = mysqli_real_escape_string($con, $fecha_de_entrega);
    $grupo_encargado = mysqli_real_escape_string($con, $grupo_encargado);
    $funcionario = mysqli_real_escape_string($con, $funcionario);
    $evento = mysqli_real_escape_string($con, $evento);
    $observaciones = mysqli_real_escape_string($con, $observaciones);
    $anulada = mysqli_real_escape_string($con, $anulada);



    $sql = "UPDATE requisicion SET num_requisicion='$num_requisicion', docente='$docente', fecha_solicitud='$fecha_solicitud', fecha_de_entrega='$fecha_de_entrega', grupo_encargado='$grupo_encargado', funcionario='$funcionario', evento='$evento', observaciones='$observaciones', anulada='$anulada' WHERE id='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header("Location: requisicion.php");
    } else {
        echo "Error al actualizar el registro";
    }
}
?>
