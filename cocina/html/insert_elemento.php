<?php
// Establece la conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "hotel";

// Crear conexión
$con = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}

// Obtener los datos del formulario
$id = $_POST['id'];
$elementos = $_POST['elementos'];
$tipo_elemento = $_POST['tipo_elemento'];
$clase = $_POST['clase'];
$inventario = $_POST['inventario'];

// Preparar la consulta
$stmt = $con->prepare("INSERT INTO elementos (id, elementos, tipo_elemento, clase, inventario) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("issss", $id, $elementos, $tipo_elemento, $clase, $inventario);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Nuevo elemento agregado exitosamente";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$con->close();

// Redirigir de vuelta a la página de elementos
header("Location: elementos.php");
exit();
?>
