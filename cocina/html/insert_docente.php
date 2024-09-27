<?php
include("connection.php");
$con = connection();

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$curso = $_POST['curso'];
$activo = $_POST['activo'];

// Asegúrate de que los nombres de los campos coincidan con los de la base de datos
$sql = "INSERT INTO docentes (id, nombre, curso, activo) 
        VALUES('$id', '$nombre', '$curso', '$activo')";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: docente.php");
} else {
    echo "Error al insertar usuario: " . mysqli_error($con);
}

// Cerrar conexión
mysqli_close($con);
?>
