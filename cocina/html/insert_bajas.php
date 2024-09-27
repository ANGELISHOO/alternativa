<?php
// Establecer la conexión a la base de datos
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

// Obtener los datos enviados desde el formulario
$id = $_POST['id'];
$elemento = $_POST['elemento'];
$baja = $_POST['baja'];
$fecha = $_POST['fecha'];
$afectada = $_POST['afectada'];

// Verificar si el elemento y la baja ya existen
$checkQuery = "SELECT * FROM bajas WHERE id='$id'";
$checkResult = mysqli_query($con, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    echo "Error: Ya existe una baja con ese ID.";
} else {
    // Insertar la nueva baja en la base de datos
    $query = "INSERT INTO bajas (id, elemento, baja, fecha, afectada) VALUES ('$id', '$elemento', '$baja', '$fecha', '$afectada')";
    
    if (mysqli_query($con, $query)) {
        // Actualizar la tabla inventario
        $updateQuery = "
            UPDATE inventario
            SET cantidad_inicial = cantidad_inicial - '$baja'
            WHERE elementos = '$elemento'
        ";
        
        if (mysqli_query($con, $updateQuery)) {
            echo "Baja agregada y cantidad en inventario actualizada exitosamente.";
        } else {
            echo "Error al actualizar el inventario: " . mysqli_error($con);
        }
    } else {
        echo "Error al agregar la baja: " . mysqli_error($con);
    }
}

// Cerrar la conexión
mysqli_close($con);

// Redirigir de vuelta al formulario
header("Location: bajas.php");
exit();
?>
