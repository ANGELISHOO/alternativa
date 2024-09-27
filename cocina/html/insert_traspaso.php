<?php
include("connection.php");
$con = connection();

$id = $_POST['id'];
$elemento = $_POST['elemento'];
$baja = $_POST['baja'];
$fecha = $_POST['fecha'];
$afectada = $_POST['afectada'];
$descripcion = $_POST['descripcion'];


// Asegúrate de que los nombres de los campos coincidan con los de la base de datos
$sql = "INSERT INTO traspaso (id, elemento, baja, fecha, afectada, descripcion) 
        VALUES('$id', '$elemento', '$baja', '$fecha', '$afectada', '$descripcion')";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: traspaso.php");
} else {
    echo "Error al insertar usuario: " . mysqli_error($con);
}

// Cerrar conexión
mysqli_close($con);
?>
