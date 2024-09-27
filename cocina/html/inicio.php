<?php
session_start();

// Conectar a la base de datos
$link = new mysqli('localhost', 'root', '', 'hotel');
if ($link->connect_error) {
    die("Error al conectar a la base de datos: " . $link->connect_error);
}

// Obtener datos del formulario
$usuario = isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : '';
$contrasena = isset($_POST['pass']) ? htmlspecialchars($_POST['pass']) : '';

// Inicializar el array de errores
$errors = [];

if (!empty($usuario) && !empty($contrasena)) {
    // Preparar la consulta para evitar SQL Injection
    $consulta = $link->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $consulta->bind_param('s', $usuario);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        // Verificar la contraseña utilizando password_verify si está encriptada
        if (password_verify($contrasena, $fila['pass'])) {
            $_SESSION['usuario_autenticado'] = true;
            $_SESSION['usuario'] = $fila['usuario'];
            $_SESSION['pass'] = $fila['pass'];
            $_SESSION['login_exitoso'] = true;

            // Redireccionar según el nivel de seguridad
            switch ($fila['id_nivel']) {
                case '1':
                    header("Location: menu.php");
                    exit();
                case '2':
                    header("Location: menu2.php");
                    exit();
                default:
                    header("Location: error.html");
                    exit();
            }
        } else {
            $_SESSION['login_exitoso'] = false;
            $errors[] = "Contraseña incorrecta";
        }
    } else {
        $_SESSION['login_exitoso'] = false;
        $errors[] = "Usuario no encontrado";
    }
    $consulta->close();
} else {
    $errors[] = "Por favor, complete todos los campos.";
}

$link->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="inicio2.css">
</head>
<body>
    <?php
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<div id="error-box">';
            echo '<div class="dot"></div>';
            echo '<div class="dot two"></div>';
            echo '<div class="face2">';
            echo '<div class="eye"></div>';
            echo '<div class="eye right"></div>';
            echo '<div class="mouth sad"></div>';
            echo '</div>';
            echo '<div class="shadow move"></div>';
            echo '<div class="message">';
            echo '<h1 class="alert red">Error!</h1>';
            echo '<p>' . htmlspecialchars($error) . '</p>'; // Asegurarse de que los mensajes de error se muestren correctamente
            echo '</div>';
            echo '<a href="inicio.html"><button class="button-box"><h1 class="red">Regresar</h1></button></a>';
            echo '</div>';
        }
    }
    ?>
</body>
</html>