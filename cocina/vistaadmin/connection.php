<?php
function connection() {
    $con = new mysqli('localhost', 'root', '', 'hotel');

    if ($con->connect_error) {
        die("Error al conectar a la base de datos: " . $con->connect_error);
    }

    return $con;
}
?>
