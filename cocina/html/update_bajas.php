<?php
include("connection.php");
$con = connection();

$id = $_GET['id'];

$sql = "SELECT * FROM bajas WHERE id='$id'";
$query = mysqli_query($con, $sql);

// Verificar si se encontró alguna fila
if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_array($query);
} else {
    // Redirigir o mostrar un mensaje si no se encontró el ID
    echo "No se encontró ninguna baja con ese ID.";
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../output.css" />
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.1.0/uicons-bold-rounded/css/uicons-bold-rounded.css" />
    <title>Editar Bajas</title>
</head>

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
    }

    input[type="text"],
    input[type="number"],
    input[type="email"],
    input[type="date"],
    input[type="submit"],
    select {
        display: block;
        width: 100%;
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

    .grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 4px;
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

<body class="main m-0 overflow-y-scroll py-2">
    <div class="container">
        <div>
        <a href="bajas.php" class="back-button">Volver</a>
        </div>
        <form action="edit_bajas.php" method="POST"><h2>Actualizar</h2>
            <input type="hidden" name="id" value="<?= $row['id'] ?>" class="h-11 rounded-xl border-none dark:text-[#E2E8F0] bg-slate-300/60 font-normal outline-none focus:bg-[#FFFFFF] focus:ring-2 focus:ring-Light-Blue dark:bg-[#27282be8] dark:placeholder:text-[#7a8190] dark:focus:bg-[#242528]">
            <select name="elemento" id="elemento" class="select" required>
                <option value="">Elemento</option>
                <?php
                    $query = "SELECT * FROM ingreso_elementos";
                    $result = mysqli_query($con, $query) or die(mysqli_error($con));
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<option value="'.$row['elemento'].'">'.$row['elemento'].'</option>';
                    }
                ?>
            </select>             <input type="number" name="baja" placeholder="Baja" value="<?= $row['baja'] ?>" class="h-11 rounded-xl border-none dark:text-[#E2E8F0] bg-slate-300/60 font-normal outline-none focus:bg-[#FFFFFF] focus:ring-2 focus:ring-Light-Blue dark:bg-[#27282be8] dark:placeholder:text-[#7a8190] dark:focus:bg-[#242528]">
            <input type="date" name="fecha" placeholder="Fecha" value="<?= $row['fecha'] ?>" class="h-11 rounded-xl border-none dark:text-[#E2E8F0] bg-slate-300/60 font-normal outline-none focus:bg-[#FFFFFF] focus:ring-2 focus:ring-Light-Blue dark:bg-[#27282be8] dark:placeholder:text-[#7a8190] dark:focus:bg-[#242528]">
            <select name="afectada" id="afectada" class="select" required>
                    <option value="afectada">Afectada</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                </select>
            <input type="submit" value="Actualizar" class="rounded-[9px] bg-gradient-to-r from-Light-Blue to-Fucsia px-4 py-[7px] text- font-[450] text-slate-100 hover:cursor-pointer">
        </form>
    </div>
    <script>
        function regresar() {
            window.location.href = "bajas.php";
        }
    </script>
</body>

</html>
