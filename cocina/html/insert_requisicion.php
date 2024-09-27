<?php
include("connection.php");
$con = connection();

// Recoger los datos del formulario y validar si son correctos
$num_requisicion = mysqli_real_escape_string($con, $_POST['num_requisicion']);
$fecha_solicitud = mysqli_real_escape_string($con, $_POST['fecha_solicitud']);
$fecha_de_entrega = mysqli_real_escape_string($con, $_POST['fecha_de_entrega']);
$grupo_encargado = mysqli_real_escape_string($con, $_POST['grupo_encargado']);
$funcionario = mysqli_real_escape_string($con, $_POST['funcionario']);
$evento = mysqli_real_escape_string($con, $_POST['evento']);
$observaciones = mysqli_real_escape_string($con, $_POST['observaciones']);
$anulada = mysqli_real_escape_string($con, $_POST['anulada']);
$id_docente = mysqli_real_escape_string($con, $_POST['id_docente']);
$id_elemento = mysqli_real_escape_string($con, $_POST['id_elemento']); // Identificar el artículo
$cantidad_requisicion = mysqli_real_escape_string($con, $_POST['cantidad_requisicion']); // Cantidad solicitada

// Iniciar la transacción
mysqli_begin_transaction($con);

try {
    // Verificar la cantidad disponible en el inventario
    $sql_check_inventario = "SELECT cantidad_final FROM inventario WHERE id = ?";
    $stmt_check = mysqli_prepare($con, $sql_check_inventario);
    mysqli_stmt_bind_param($stmt_check, 'i', $id_elemento);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_bind_result($stmt_check, $cantidad_actual);
    mysqli_stmt_fetch($stmt_check);
    mysqli_stmt_close($stmt_check);

    // Validar que hay suficiente cantidad en el inventario
    if ($cantidad_requisicion > $cantidad_actual) {
        throw new Exception("No hay suficientes elementos en el inventario.");
    }

    // Inserta la requisición
    $sql = "INSERT INTO requisicion (num_requisicion, fecha_solicitud, fecha_de_entrega, grupo_encargado, funcionario, evento, observaciones, anulada, id_docente, id_elemento, cantidad_requisicion) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);


    if ($stmt) {
        // Vincular los parámetros con los datos
        mysqli_stmt_bind_param($stmt, 'ssssssssssi', $num_requisicion, $fecha_solicitud, $fecha_de_entrega, $grupo_encargado, $funcionario, $evento, $observaciones, $anulada, $id_docente, $id_elemento, $cantidad_requisicion);

        // Ejecutar la consulta
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error al insertar la requisición: " . mysqli_error($con));
        }

        // Actualiza el inventario restando la cantidad solicitada
        $sql_update_inventario = "UPDATE inventario SET cantidad_final = cantidad_final - ? WHERE id = ?";
        $stmt_update = mysqli_prepare($con, $sql_update_inventario);

        if ($stmt_update) {
            mysqli_stmt_bind_param($stmt_update, 'ii', $cantidad_requisicion, $id_elemento);

            if (!mysqli_stmt_execute($stmt_update)) {
                throw new Exception("Error al actualizar el inventario: " . mysqli_error($con));
            }

            // Si todo va bien, confirmar la transacción
            mysqli_commit($con);
            Header("Location: requisicion.php");
            exit(); // Asegúrate de salir después de redirigir
        } else {
            throw new Exception("Error al preparar la actualización del inventario: " . mysqli_error($con));
        }

        // Cerrar las sentencias
        mysqli_stmt_close($stmt_update);
    } else {
        throw new Exception("Error en la preparación de la consulta de requisición: " . mysqli_error($con));
    }

    // Cerrar la sentencia de inserción
    mysqli_stmt_close($stmt);
} catch (Exception $e) {
    // Si ocurre un error, revertir la transacción
    mysqli_rollback($con);
    echo $e->getMessage();
}

// Cerrar conexión
mysqli_close($con);
?>
