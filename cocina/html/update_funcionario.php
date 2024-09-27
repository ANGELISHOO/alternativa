<?php
include("connection.php");
$con = connection();

$id = $_GET['id'];

$sql = "SELECT * FROM funcionario WHERE id='$id'";
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
    <title>Editar Funcionarios</title>
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
        input[type="password"],
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
</head>

<body class="main m-0 overflow-y-scroll py-2">
    <div>
        <div>
        <a href="funcionarios.php" class="back-button">Volver</a>
        </div>
        <div class="container">
            <div class="text">Editar Funcionario</div>
            <form action="edit_funcionario.php" method="POST">
                <input type="hidden" name="id" value="<?= $row['id'] ?>" class="h-11 w-[320px] rounded-xl border-none dark:text-[#E2E8F0] bg-slate-300/60 font-normal outline-none focus:bg-[#FFFFFF] focus:ring-2 focus:ring-Light-Blue dark:bg-[#27282be8] dark:placeholder:text-[#7a8190] dark:focus:bg-[#242528] S1:h-[60px] S1:w-[480px] S1:rounded-[17px] S1:px-5 S1:py-4 S1:text-[20px] S2:h-[50px] S2:w-[400px] S2:rounded-[14px] S2:px-4 S2:py-3 S2:text-[18px] S3:h-11 S3:w-[320px] S3:rounded-xl S3:px-3 S3:py-2 S3:text-[16px]">
                <input type="text" name="funcionario" placeholder="Funcionario" value="<?= $row['funcionario'] ?>" class="h-11 w-[320px] dark:text-[#E2E8F0] rounded-xl border-none bg-slate-300/60 font-normal outline-none focus:bg-[#FFFFFF] focus:ring-2 focus:ring-Light-Blue dark:bg-[#27282be8] dark:placeholder:text-[#7a8190] dark:focus:bg-[#242528] S1:h-[60px] S1:w-[480px] S1:rounded-[17px] S1:px-5 S1:py-4 S1:text-[20px] S2:h-[50px] S2:w-[400px] S2:rounded-[14px] S2:px-4 S2:py-3 S2:text-[18px] S3:h-11 S3:w-[320px] S3:rounded-xl S3:px-3 S3:py-2 S3:text-[16px]">
                <select name="activo" id="activo" class="select" required>
                    <option value="">Activo</option>
                    <?php
                    $query = "SELECT * FROM activo";
                    $result = mysqli_query($con, $query) or die(mysqli_error($con));
                    while ($activoRow = mysqli_fetch_array($result)) {
                        echo '<option value="'.$activoRow['activo'].'">'.$activoRow['activo'].'</option>';
                    }
                    ?>
                </select>
                <input type="submit" value="Actualizar" class="rounded-[9px] bg-gradient-to-r from-Light-Blue to-Fucsia px-4 py-[7px] text- font-[450] text-slate-100 hover:cursor-pointer">
            </form>
        </div>
    </div>
    <script>
        function regresar() {
            window.location.href = "funcionarios.php";
        }
    </script>
</body>

</html>
