<?php
include("connection.php");
$con = connection();

$id = $_GET['id'];

// Sanitizar el ID para evitar inyecciones SQL
$id = mysqli_real_escape_string($con, $id);

$sql = "SELECT * FROM ingreso_elementos WHERE id='$id'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../output.css" />
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.1.0/uicons-bold-rounded/css/uicons-bold-rounded.css" />
    <title>Editar Elemento</title>
    <style>
    /* Estilos unificados */
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
@import url('https://fonts.googleapis.com/css?family=Lato:100,300,400');
@import url('https://fonts.googleapis.com/css?family=Roboto:100');

* {
    margin: 0;
    padding: 0;
    outline: none;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 10px;
    background: #cfcfcf;
    position: relative;
}

.back-button {
    position: absolute;
    top: 20px;
    left: 20px;
    background: #e28d55;
    border: none;
    color: #ffffff;
    font-size: 17px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    padding: 12px 30px;
    margin: 5px;
    transition: background 0.3s ease, color 0.3s ease;
    text-decoration: none;
}

.back-button:hover {
    background: #fff;
    color: #f0a855;
}

.container {
    max-width: 800px;
    background: #fff;
    width: 100%;
    padding: 25px 40px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.text {
    font-size: 41px;
    font-weight: 600;
    color: #F18F4E;
    margin-bottom: 20px;
}

.button-container {
    margin-bottom: 30px;
    text-align: center;
}

.button-container button {
    background: #dddbdb;
    border: none;
    color: #F18F4E;
    font-size: 17px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    padding: 12px 30px;
    margin: 5px;
    transition: background 0.3s ease, color 0.3s ease;
}

.button-container button:hover {
    background: #e29b4b;
    color: #fff;
}

form {
    background: #fff;
    padding: 20px 0;
    display: flex;
    flex-direction: column;
    align-items: center;
}

input[type="text"],
input[type="number"],
input[type="email"],
input[type="date"],
input[type="submit"],
select {
    display: block;
    width: 100%;
    max-width: 500px; /* Opcional: Ajustar el ancho máximo del formulario */
    padding: 12px;
    margin-bottom: 20px;
    border: 2px solid #ddd;
    font-size: 16px;
    border-radius: 4px;
    box-sizing: border-box;
    transition: all 0.3s ease;
}

input[type="submit"] {
    background: #f18f4e;
    color: #fff;
    border: none;
    cursor: pointer;
}

input[type="submit"]:hover {
    background: #e29b4b;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
}

th {
    background: #f18f4e;
    color: #fff;
}

td {
    background: #f9f9f9;
}

.grid-btns-crud div {
    margin: 5px;
}

.grid-btns-crud a {
    background-color: #f18f4e;
    color: white;
    padding: 8px 16px;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
    display: inline-block;
}

.grid-btns-crud a:hover {
    background-color: #e29b4b;
}

</style>
</head>

<body class="main m-0 overflow-y-scroll py-2">
    <div class="container">
        <div>
            <a href="ingreso_elementos.php" class="back-button">Volver</a>
        </div>
        <div>
            <form action="edit_ingreso_elementos.php" method="POST">
                <div class="grid grid-rows-11 gap-3 justify-items-center">
                    <div>
                        <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>" />
                    </div>
                    <div>
                        <input type="text" name="elemento" placeholder="Elemento" value="<?= htmlspecialchars($row['elemento']) ?>" required />
                    </div>
                    <div>
                        <input type="number" name="cantidad" placeholder="Cantidad" value="<?= htmlspecialchars($row['cantidad']) ?>" required />
                    </div>
                    <div>
                        <input type="date" name="fecha" placeholder="Fecha" value="<?= htmlspecialchars($row['fecha']) ?>" required />
                    </div>
                    <div>
                        <input type="text" name="ubicacion" placeholder="Ubicacion" value="<?= htmlspecialchars($row['ubicacion']) ?>" required />
                    </div>
                    <div>
                        <input type="text" name="afectada" placeholder="Afectada" value="<?= htmlspecialchars($row['afectada']) ?>" required />
                    </div>
                    <div>
                        <input type="submit" value="Actualizar" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function regresar() {
            window.location.href = "ingreso_elementos.php";
        }
    </script>
</body>

</html>
