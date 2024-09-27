<?php
include("connection.php");
$con = connection();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users CRUD</title>
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

<body class="main m-0 overflow-y-scroll pb-[22px]">
    <div>
        <div class="grid grid-crud-users gap-12">
            <!-- CREAR USUARIO -->
            <div>
                <!-- HEADER -->
                <div class="flex justify-center text-center">
                    <header 
                    class="my-4 w-2/3 rounded-xl bg-gradient-to-r from-Light-Blue to-Fucsia p-1.5 text-center text-[#DFE4EBEF] shadow-md"
                    >
                        <h1 
                        class="text-[26px] font-semibold">
                        Crear Usuario
                        </h1>
                    </header>
                </div>
                <!------------------------------>
                <!-- FORMULARIO NUEVO USUARIO -->
                <div>
                    <div class="flex justify-center">
                        <form action="insert_user.php" method="POST">
                            <div class="grid grid-rows-11 gap-3 justify-items-center">
                                <div>
                                    <input type="number" name="id_usuario" placeholder="ID" class="id_usuario">
                                <div>
                                    <input type="text" name="nombre_usuario" placeholder="Nombres del usuario" class="nombre_usuario">
                                </div>
                                <div>
                                    <input type="text" name="usuario" placeholder="Usuario" class="usuario">
                                </div>
                                <div>
                                    <input type="password" name="pass" placeholder="Contraseña" class="pass">
                                </div>
                                <div>
                                    <input type="text" name="nivel_seguridad" placeholder="Rol" class="nivel_seguridad">
                                </div>
                                <div>
                                    <input type="submit" value="Agregar" class="rounded-[9px] bg-gradient-to-r from-Light-Blue to-Fucsia px-4 py-[7px] text- font-[450] text-slate-100 hover:cursor-pointer">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!------------------------------>
            </div>
            <!-------------------------->
            <!-- USUARIOS REGISTRADOS -->
            <div>
                <!-- HEADER -->
                <div class="flex justify-center text-center">
                    <header 
                    class="my-4 w-2/3 rounded-xl bg-gradient-to-r from-Light-Blue to-Fucsia p-1.5 text-center text-[#DFE4EBEF] shadow-md"
                    >
                        <h1 
                        class="text-[26px] font-semibold">
                        Usuarios registrados
                        </h1>
                    </header>
                </div>
                <!------------------>
                <!-- TABLA -->
                <div class="flex justify-center">
                    <table class="border-2 border-neutral-400 dark:border-neutral-700 w-4/5">
                        <thead>
                            <tr class="border-2 border-neutral-400 dark:border-neutral-700 text-xs text-center dark:bg-[#242528] bg-slate-400/70 font-bold h-8 dark:text-slate-200">
                                <th class="border-2 border-neutral-400 dark:border-neutral-700 p-1.5">ID</th>
                                <th class="border-2 border-neutral-400 dark:border-neutral-700 p-1.5">Nombre del usuarios</th>
                                <th class="border-2 border-neutral-400 dark:border-neutral-700 p-1.5">Usuario</th>
                                <th class="border-2 border-neutral-400 dark:border-neutral-700 p-1.5">Contraseña</th>
                                <th class="border-2 border-neutral-400 dark:border-neutral-700 p-1.5">Rol</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM usuarios";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) { ?>
                                <tr class="border border-neutral-400 text-xs text-center dark:bg-[#27282be8] bg-slate-300/75 dark:text-[#dfe4ebef]">
                                    <th class="border-2 border-neutral-400 dark:border-neutral-700 text-xs text-center font-normal p-1.5"><?php echo $row["id_usuario"]; ?></th>
                                    <th class="border-2 border-neutral-400 dark:border-neutral-700 text-xs text-center font-normal p-1.5"><?php echo $row["nombre_usuario"]; ?></th>
                                    <th class="border-2 border-neutral-400 dark:border-neutral-700 text-xs text-center font-normal p-1.5"><?php echo $row["usuario"]; ?></th>
                                    <th class="border-2 border-neutral-400 dark:border-neutral-700 text-xs text-center font-normal p-1.5"><?php echo $row["pass"]; ?></th>
                                    <th class="border-2 border-neutral-400 dark:border-neutral-700 text-xs text-center font-normal p-1.5"><?php echo $row["nivel_seguridad"]; ?></th>
                                    <th class="border-2 border-neutral-400 dark:border-neutral-700 font-normal p-1.5">
                                        <div class="grid grid-btns-crud gap-4">
                                            <div>
                                                <a href="update.php?id=<?= $row["id_usuario"] ?>" class="bg-teal-500 p-1.5 rounded-[4px]">Editar</a>
                                            </div>
                                            <div>
                                            <a href="delete_user.php?id=<?= $row["id_usuario"] ?>" class="bg-rose-500 p-1.5 rounded-[4px]">Eliminar</a>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!------------------>
            </div>
            <!-------------------------->
            <!-- BOTONES DESCARGAR/IMPRIMIR -->
            <div>
                <div class="grid grid-cols-3 gap-4 justify-items-center">
                    <div>
                        <button class="rounded-[9px] bg-zinc-700 px-4 py-[7px] font-[450] text-slate-100 hover:cursor-pointer" onclick="window.print()">Imprimir Página</button>
                    </div>
                    <div>
                        <a href="excel.php">
                            <button class="rounded-[9px] bg-green-600 px-4 py-[7px] font-[450] text-slate-100 hover:cursor-pointer">Descargar en Excel</button>
                        </a>
                    </div>
                    <div>
                        <a href="pdf.php">
                            <button class="rounded-[9px] bg-red-600 px-4 py-[7px] font-[450] text-slate-100 hover:cursor-pointer">Descargar en PDF</button>
                        </a>
                    </div>
                </div>
            </div>
            <!-------------------------->
        </div>
    </div>
</body>

