<?php
include("connection.php");
$con = connection();

$id = $_GET['id'];

$sql = "SELECT * FROM usuarios WHERE id_usuario='$id'";
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
    <title>Editar usuarios</title>
</head>

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
/* Estilo para los botones de descarga */
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


a{
    text-decoration: none;
}


.users-form form{
    display: flex;
    flex-direction: column;
    gap: 24px;
    width: 30%;
    margin: 20px auto;
    text-align: center;
}

.users-form form input{
    font-family: 'Segoe UI', sans-serif;
}

.users-form form input[type=text],
.users-form form input[type=password],
.users-form form input[type=email]{
    padding: 8px;
    border:2px solid #aaa;
    border-radius:4px;
    outline:none;
    transition:.3s;
}

.users-form form input[type=text]:focus,
.users-form form input[type=password]:focus,
.users-form form input[type=password]:focus{
    border-color:dodgerBlue;
    box-shadow:0 0 6px 0 dodgerBlue;
}

.users-form form input[type=submit]{
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

.users-table {
    border: 1px solid #ccc;
    border-collapse: collapse;
    margin: 0;
    padding: 0;
    width: 100%;
    table-layout: fixed;
}

table tr {
    background-color: #f8f8f8;
    border: 1px solid #ddd;
    padding: 4px;
}

table th{
    padding: 16px;
    text-align: center;
    font-size: .85em;
}

.users-table--edit{
    background: #009688;
    padding: 6px;
    color: #fff;
    text-align: center;
    font-weight: bold;
}
.users-table--delete{
    background: #b11e1e;
    padding: 6px;
    color: #fff;
    text-align: center;
    font-weight: bold;
}
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;

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

<body class="main m-0 overflow-y-scroll py-2">
    <div>
        <div>
            <i class="fi fi-br-angle-left cursor-pointer rounded-full bg-gradient-to-r from-Light-Blue to-Fucsia p-2 pb-[5px] pr-[9px]" onclick="regresar()"></i>
        </div>
        <div>
            <form action="edit_user.php" method="POST">
                <div class="grid grid-rows-11 gap-3 justify-items-center">
                    <div>
                        <input type="hidden" name="id_usuario" value="<?= $row['id_usuario'] ?>" class="h-11 w-[320px] rounded-xl border-none dark:text-[#E2E8F0] bg-slate-300/60 font-normal outline-none focus:bg-[#FFFFFF] focus:ring-2 focus:ring-Light-Blue dark:bg-[#27282be8] dark:placeholder:text-[#7a8190] dark:focus:bg-[#242528] S1:h-[60px] S1:w-[480px] S1:rounded-[17px] S1:px-5 S1:py-4 S1:text-[20px] S2:h-[50px] S2:w-[400px] S2:rounded-[14px] S2:px-4 S2:py-3 S2:text-[18px] S3:h-11 S3:w-[320px] S3:rounded-xl S3:px-3 S3:py-2 S3:text-[16px]">
                    </div>
                    <div>
                        <input type="text" name="nombre_usuario" placeholder="Nombre del usuario" value="<?= $row['nombre_usuario'] ?>" class="h-11 w-[320px] dark:text-[#E2E8F0] rounded-xl border-none bg-slate-300/60 font-normal outline-none focus:bg-[#FFFFFF] focus:ring-2 focus:ring-Light-Blue dark:bg-[#27282be8] dark:placeholder:text-[#7a8190] dark:focus:bg-[#242528] S1:h-[60px] S1:w-[480px] S1:rounded-[17px] S1:px-5 S1:py-4 S1:text-[20px] S2:h-[50px] S2:w-[400px] S2:rounded-[14px] S2:px-4 S2:py-3 S2:text-[18px] S3:h-11 S3:w-[320px] S3:rounded-xl S3:px-3 S3:py-2 S3:text-[16px]">
                    </div>
                    <div>
                        <input type="text" name="usuario" placeholder="Usuario" value="<?= $row['usuario'] ?>" class="h-11 w-[320px] dark:text-[#E2E8F0] rounded-xl border-none bg-slate-300/60 font-normal outline-none focus:bg-[#FFFFFF] focus:ring-2 focus:ring-Light-Blue dark:bg-[#27282be8] dark:placeholder:text-[#7a8190] dark:focus:bg-[#242528] S1:h-[60px] S1:w-[480px] S1:rounded-[17px] S1:px-5 S1:py-4 S1:text-[20px] S2:h-[50px] S2:w-[400px] S2:rounded-[14px] S2:px-4 S2:py-3 S2:text-[18px] S3:h-11 S3:w-[320px] S3:rounded-xl S3:px-3 S3:py-2 S3:text-[16px]">
                    </div>
                    <div>
                        <input type="password" name="pass" placeholder="Contraseña" value="<?= $row['pass'] ?>" class="h-11 w-[320px] dark:text-[#E2E8F0] rounded-xl border-none bg-slate-300/60 font-normal outline-none focus:bg-[#FFFFFF] focus:ring-2 focus:ring-Light-Blue dark:bg-[#27282be8] dark:placeholder:text-[#7a8190] dark:focus:bg-[#242528] S1:h-[60px] S1:w-[480px] S1:rounded-[17px] S1:px-5 S1:py-4 S1:text-[20px] S2:h-[50px] S2:w-[400px] S2:rounded-[14px] S2:px-4 S2:py-3 S2:text-[18px] S3:h-11 S3:w-[320px] S3:rounded-xl S3:px-3 S3:py-2 S3:text-[16px]">
                    </div>
                    <div>
                        <input type="text" name="nivel_seguridad" placeholder="Rol" value="<?= $row['nivel_seguridad'] ?>" class="h-11 w-[320px] dark:text-[#E2E8F0] rounded-xl border-none bg-slate-300/60 font-normal outline-none focus:bg-[#FFFFFF] focus:ring-2 focus:ring-Light-Blue dark:bg-[#27282be8] dark:placeholder:text-[#7a8190] dark:focus:bg-[#242528] S1:h-[60px] S1:w-[480px] S1:rounded-[17px] S1:px-5 S1:py-4 S1:text-[20px] S2:h-[50px] S2:w-[400px] S2:rounded-[14px] S2:px-4 S2:py-3 S2:text-[18px] S3:h-11 S3:w-[320px] S3:rounded-xl S3:px-3 S3:py-2 S3:text-[16px]">
                    </div>
                    <div>
                        <input type="submit" value="Actualizar" class="rounded-[9px] bg-gradient-to-r from-Light-Blue to-Fucsia px-4 py-[7px] text- font-[450] text-slate-100 hover:cursor-pointer">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function regresar() {
            window.location.href = "crud_usuarios.php";
        }
    </script>
</body>

</html>
