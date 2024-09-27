<?php
include("connection.php");
$con = connection();

$id = $_GET['id'];

// Sanitizar el ID para evitar inyecciones SQL
$id = mysqli_real_escape_string($con, $id);

$sql = "SELECT * FROM traspaso WHERE id='$id'";
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
    <title>Editar Traspaso</title>
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

        .btn-download {
            display: inline-block;
            padding: 10px 20px;
            margin-right: 10px;
            text-align: center;
            text-decoration: none;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-excel {
            background-color: #4CAF50;
        }

        .btn-pdf {
            background-color: #FF5722;
        }

        .btn-download:hover {
            background-color: #0b7dda;
        }

        a {
            text-decoration: none;
        }

        .users-form form {
            display: flex;
            flex-direction: column;
            gap: 24px;
            width: 30%;
            margin: 20px auto;
            text-align: center;
        }

        .users-form form input {
            font-family: 'Segoe UI', sans-serif;
        }

        .users-form form input[type=text],
        .users-form form input[type=date] {
            padding: 8px;
            border: 2px solid #aaa;
            border-radius: 4px;
            outline: none;
            transition: .3s;
        }

        .users-form form input[type=text]:focus,
        .users-form form input[type=date]:focus {
            border-color: dodgerBlue;
            box-shadow: 0 0 6px 0 dodgerBlue;
        }

        .users-form form input[type=submit] {
            border: none;
            padding: 12px 50px;
            text-decoration: none;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 5px;
            background-color: white;
            color: black;
            border: 2px solid #60a100;
        }

        .users-form form input[type=submit]:hover {
            background-color: #60a100;
            color: white;
        }

        section {
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        input {
            width: 30vw;
            padding: 10px;
            outline: none;
            border: 5px solid;
            font-weight: 600;
        }

        #listaCanciones {
            list-style: none;
            margin-top: 20px;
            text-align: center;
        }

        .filtro {
            display: none;
        }
    </style>
</head>

<body class="main m-0 overflow-y-scroll py-2">
    <div>
        <div>
            <i class="fi fi-br-angle-left cursor-pointer rounded-full bg-gradient-to-r from-Light-Blue to-Fucsia p-2 pb-[5px] pr-[9px]" onclick="regresar()"></i>
        </div>
        <div>
            <form action="edit_traspaso.php" method="POST">
                <div class="grid grid-rows-11 gap-3 justify-items-center">
                    <div>
                        <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>" />
                    </div>
                    <div>
                        <input type="text" name="elemento" placeholder="Elemento" value="<?= htmlspecialchars($row['elemento']) ?>" required />
                    </div>
                    <div>
                        <input type="text" name="baja" placeholder="Baja" value="<?= htmlspecialchars($row['baja']) ?>" required />
                    </div>
                    <div>
                        <input type="date" name="fecha" placeholder="Fecha" value="<?= htmlspecialchars($row['fecha']) ?>" required />
                    </div>
                    <div>
                        <input type="text" name="afectada" placeholder="Afectada" value="<?= htmlspecialchars($row['afectada']) ?>" required />
                    </div>
                    <div>
                        <input type="text" name="descripcion" placeholder="Descripción" value="<?= htmlspecialchars($row['descripcion']) ?>" required />
                    </div>
                    <div>
                        <input type="submit" value="Actualizar" class="rounded-[9px] bg-gradient-to-r from-Light-Blue to-Fucsia px-4 py-[7px] text-slate-100 font-[450] hover:cursor-pointer" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function regresar() {
            window.location.href = "traspaso.php";
        }
    </script>
</body>

</html>
