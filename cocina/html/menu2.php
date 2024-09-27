menu2.php
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --navbar-width: 260px;
            --navbar-width-collapsed: 80px;
            --navbar-dark-primary: #0d9e06;
            --navbar-light-primary: #ecf0f1;
            --navbar-light-secondary: #bdc3c7;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-image: url('portada3.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }

        #nav-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--navbar-width);
            background-color: var(--navbar-dark-primary);
            min-height: 100vh;
            padding: 16px;
            box-sizing: border-box;
            transition: width 0.3s ease;
        }

        #nav-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--navbar-light-secondary);
            position: relative;
        }

        #nav-title {
            font-size: 1.5rem;
            color: var(--navbar-light-primary);
            transition: opacity 0.3s ease;
        }

        #nav-toggle {
            display: none;
        }

        #nav-toggle-label {
            cursor: pointer;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            right: 0;
            margin-left: 100px;
            
        }

        #nav-toggle-label svg {
            fill: var(--navbar-light-primary);
            transition: transform 0.3s ease;
        }

        #nav-toggle:checked ~ #nav-bar {
            width: var(--navbar-width-collapsed);
        }

        #nav-toggle:checked ~ #nav-bar #nav-title {
            opacity: 0;
        }

        #nav-toggle:checked ~ #nav-bar #nav-toggle-label svg {
            transform: rotate(180deg);
        }

        #nav-toggle:checked ~ #nav-bar #nav-toggle-label {
            right: calc(var(--navbar-width-collapsed) / 2 - 12px);
        }

        #nav-toggle:checked ~ #nav-bar #nav-content .menu-text {
            display: none;
        }

        #nav-content {
            padding-top: 16px;
            transition: all 0.3s ease;
        }

        .nav-button {
            display: flex;
            align-items: center;
            margin: 8px 0;
            padding: 10px 16px;
            background-color: transparent;
            color: var(--navbar-light-primary);
            text-decoration: none;
            border: 1px solid var(--navbar-light-secondary);
            border-radius: 8px;
            transition: background-color 0.2s;
            text-align: left;
        }

        .nav-button:hover {
            background-color: var(--navbar-light-secondary);
            
        }

        .nav-button i {
            margin-right: 10px;
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        #nav-footer {
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid var(--navbar-light-secondary);
            display: flex;
            align-items: center;
            justify-content: space-between;
            
        }

        #nav-footer-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            overflow: hidden;
            background-color: var(--navbar-light-secondary);
        }

        #nav-footer-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #nav-footer-titlebox {
            display: flex;
            flex-direction: column;
            transition: opacity 0.3s ease;
        }

        #nav-toggle:checked ~ #nav-bar #nav-footer-titlebox {
            opacity: 0;
        }

        #nav-toggle:checked ~ #nav-bar .nav-button i {
            margin-right: 0;
        }

        #nav-toggle:checked ~ #nav-bar #nav-toggle-label svg {
            transform: rotate(180deg);
        }

        #content-container {
            margin-left: var(--navbar-width);
            padding: 20px;
            flex-grow: 1;
        }
    </style>
</head>
<body>
    <input type="checkbox" id="nav-toggle">
    <div id="nav-bar">
        <div id="nav-header">
            <div id="nav-title">Menú</div>
            <label id="nav-toggle-label" for="nav-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </label>
        </div>
        <div id="nav-content">
            <a class="nav-button" href="crud_usuarios2.php">
                <i class="fa fa-users"></i>
                <span class="menu-text">Usuarios</span>
            </a>
            <a class="nav-button" href="docente2.php">
                <i class="fa fa-chalkboard-teacher"></i>
                <span class="menu-text">Docentes</span>
            </a>
            <a class="nav-button" href="bajas2.php">
                <i class="fa fa-times-circle"></i>
                <span class="menu-text">Bajas</span>
            </a>
            <a class="nav-button" href="elementos2.php">
                <i class="fa fa-cubes"></i>
                <span class="menu-text">Elementos</span>
            </a>
            <a class="nav-button" href="funcionarios2.php">
                <i class="fa fa-briefcase"></i>
                <span class="menu-text">Funcionarios</span>
            </a>
            <a class="nav-button" href="ingreso_elementos2.php">
                <i class="fa fa-boxes"></i>
                <span class="menu-text">Ingreso de elementos</span>
            </a>
            <a class="nav-button" href="inventario_actual2.php">
                <i class="fa fa-warehouse"></i>
                <span class="menu-text">Inventario</span>
            </a>
            <a class="nav-button" href="requisicion2.php">
                <i class="fa fa-file-alt"></i>
                <span class="menu-text">Requisición</span>
            </a>
            <a class="nav-button" href="traspaso2.php">
                <i class="fa fa-exchange-alt"></i>
                <span class="menu-text">Traspaso</span>
            </a>
            <a class="nav-button btn-cerrar-sesion" href="cerrar_sesion.php">
                <i class="fa fa-sign-out-alt"></i>
                <span class="menu-text">Salir</span>
            </a>
        </div>
        <div id="nav-footer">
            <div id="nav-footer-avatar">
                <img src="https://via.placeholder.com/150" alt="Avatar">
            </div>
            <div id="nav-footer-titlebox">
                <strong><?php  echo $_SESSION['usuario']; ?></strong>
                <div id="nav-footer-position">Posición del Usuario</div>
            </div>
        </div>
    </div>
    <div id="content-container">
        <!-- Aquí se cargará el contenido dinámico -->
    </div>

    <!-- Enlace a la librería de iconos de FontAwesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
