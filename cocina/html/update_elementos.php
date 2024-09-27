<?php
include("connection.php");
$con = connection();

$id = $_GET['id'];

$sql = "SELECT * FROM elementos WHERE id='$id'";
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
    <title>Editar Elementos</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
        }

        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: #0b7dda;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 24px;
            width: 100%;
            margin: 20px auto;
            text-align: center;
        }

        input[type="text"],
        input[type="submit"] {
            padding: 8px;
            border: 2px solid #aaa;
            border-radius: 4px;
            outline: none;
            transition: 0.3s;
            font-family: 'Segoe UI', sans-serif;
        }

        input[type="text"]:focus,
        input[type="submit"]:focus {
            border-color: dodgerBlue;
            box-shadow: 0 0 6px 0 dodgerBlue;
        }

        input[type="submit"] {
            background-color: white;
            color: black;
            border: 2px solid #60a100;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #60a100;
            color: white;
        }

        .btn-back {
            background-color: #e28d55;
        }

        .btn-back:hover {
            background-color: #f0a855;
        }
    </style>
</head>

<body>
    <a href="elementos.php" class="btn-back">Volver</a>
    <div class="container">
        <h1>Editar Elemento</h1>
        <form action="edit_elementos.php" method="POST">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="text" name="elementos" placeholder="Elemento" value="<?= $row['elementos'] ?>">
            <input type="text" name="tipo_elemento" placeholder="Tipo de Elemento" value="<?= $row['tipo_elemento'] ?>">
            <input type="text" name="clase" placeholder="Clase" value="<?= $row['clase'] ?>">
            <input type="text" name="inventario" placeholder="Inventario" value="<?= $row['inventario'] ?>">
            <input type="submit" value="Actualizar">
        </form>
    </div>
    <script>
        function regresar() {
            window.location.href = "elementos.php";
        }
    </script>
</body>

</html>
