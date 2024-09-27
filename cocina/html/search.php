<?php
include("connection.php");
$con = connection();

if (isset($_GET["q"])) {
    $query = $_GET["q"];
    $sql = "SELECT id_usuario, nombre_usuario, usuario, nivel_seguridad 
            FROM usuarios 
            WHERE nombre_usuario LIKE '%$query%' OR usuario LIKE '%$query%' OR nivel_seguridad LIKE '%$query%'";
    $result = mysqli_query($con, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li class='usuario' data-id='" . $row["id_usuario"] . "'>";
            echo "<span class='nombre_usuario'>" . $row["nombre_usuario"] . "</span> - ";
            echo "<span class='usuario'>" . $row["usuario"] . "</span> - ";
            echo "<span class='nivel_seguridad'>Nivel de seguridad: " . $row["nivel_seguridad"] . "</span>";
            echo "<button class='agregar'>Agregar</button>";
            echo "</li>";
        }
    } else {
        echo "<li>No se encontraron resultados</li>";
    }
}
?>
