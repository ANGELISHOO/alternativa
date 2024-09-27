<?php
// Establece la conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "hotel";

// Crear conexión
$con = mysqli_connect($host, $user, $password, $dbname);

// Verificar conexión
if (!$con) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Obtener el ID del registro a eliminar
$id = $_GET['id'];

// Eliminar el registro de la base de datos
$sql = "DELETE FROM bajas WHERE id='$id'";

if (mysqli_query($con, $sql)) {
    echo "Baja eliminada correctamente.";
} else {
    echo "Error al eliminar la baja: " . mysqli_error($con);
}

// Redirigir a la página de bajas
header("Location: bajas.php");
exit();

// Cerrar conexión
mysqli_close($con);
?>
