<?php
include("connection.php");
$con = connection();

$id = $_POST['id'];
$funcionario = $_POST['funcionario'];
$activo = $_POST['activo'];


// Asegúrate de que los nombres de los campos coincidan con los de la base de datos
$sql = "INSERT INTO funcionario (id, funcionario, activo) 
        VALUES('$id', '$funcionario', '$activo')";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: funcionarios.php");
} else {
    echo "Error al insertar usuario: " . mysqli_error($con);
}

// Cerrar conexión
mysqli_close($con);
?>
