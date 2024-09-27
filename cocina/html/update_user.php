<?php
session_start();
// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_autenticado']) || !$_SESSION['usuario_autenticado']) {
    header("Location: inicio.html");
    exit();
}
// Evitar caché del navegador
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Conectar a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "hotel";

$con = mysqli_connect($host, $user, $password, $dbname);

// Verificar conexión
if (!$con) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Obtener el ID del usuario desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consultar los datos del usuario
$query = "SELECT * FROM usuarios WHERE id = $id";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result); // Use a unique variable name
} else {
    echo "Usuario no encontrado.";
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
    <title>Editar usuarios</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
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

    .grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 4px;
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

<body>
    <a href="crud_usuarios.php" class="back-button">Volver</a>
    <div class="container">
        <div class="text">Editar Usuario</div>
        <form action="edit_user.php" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($user_data['id']) ?>">
            <input type="text" name="nombre_usuario" placeholder="Nombre del usuario" value="<?= htmlspecialchars($user_data['nombre_usuario']) ?>">
            <input type="text" name="usuario" placeholder="Usuario" value="<?= htmlspecialchars($user_data['usuario']) ?>">
            <input type="password" name="pass" placeholder="Contraseña" value="<?= htmlspecialchars($user_data['pass']) ?>">
            <select name="rol" id="rol" class="select" required>
                <option value="">Seleccione el rol</option>
                <?php
                    $query_roles = "SELECT * FROM usuarios_nivel";
                    $result_roles = mysqli_query($con, $query_roles) or die(mysqli_error($con));
                    while ($role = mysqli_fetch_array($result_roles)) {
                        $selected = ($role['nivel_usuario'] == $user_data['rol']) ? 'selected' : '';
                        echo '<option value="'.$role['nivel_usuario'].'" '.$selected.'>'.$role['nivel_usuario'].'</option>';
                    }
                ?>
            </select>            
            <input type="text" name="id_nivel" placeholder="ID Nivel" value="<?= htmlspecialchars($user_data['id_nivel']) ?>">
            <input type="submit" value="Actualizar Usuario">
        </form>
    </div>
</body>

</html>