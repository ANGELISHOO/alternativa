<?php
include("connection.php"); // Asegúrate de que este archivo contenga la conexión a la base de datos

$con = connection();

// Obtener los datos del formulario
$elemento = $_POST['elemento'];
$cantidad = $_POST['cantidad'];
$fecha = $_POST['fecha'];
$afectada = $_POST['afectada'];

// Insertar los datos en la tabla ingreso_elementos
$sql = "INSERT INTO ingreso_elementos (elemento, cantidad, fecha, afectada) VALUES ('$elemento', '$cantidad', '$fecha', '$afectada')";

if (mysqli_query($con, $sql)) {
    // Redirigir a la misma página
    header("Location: ingreso_elementos.php");
    exit();
} else {
    echo "Error al insertar los datos: " . mysqli_error($con);
}

// Buscar el tipo_elemento correspondiente en la tabla elementos
$sql_buscar_tipo = "SELECT tipo_elemento FROM elementos WHERE elementos = '$elemento'";
$result_tipo = mysqli_query($con, $sql_buscar_tipo);

if (mysqli_num_rows($result_tipo) > 0) {
    $row_tipo = mysqli_fetch_assoc($result_tipo);
    $tipo_elemento = $row_tipo['tipo_elemento'];

    // Verificar si el elemento ya existe en la tabla inventario
    $sql_verificar_inventario = "SELECT * FROM inventario WHERE elementos = '$elemento'";
    $result_inventario = mysqli_query($con, $sql_verificar_inventario);

    if (mysqli_num_rows($result_inventario) > 0) {
        // Actualizar la cantidad y la fecha de ingreso si el elemento ya existe
        // ... (código para actualizar el inventario)
    } else {
        // Insertar en la tabla inventario si el elemento no existe
        // ... (código para insertar en el inventario)
    }
} else {
    echo "Error: No se encontró el tipo de elemento para '$elemento'.";
}

mysqli_close($con);
?>