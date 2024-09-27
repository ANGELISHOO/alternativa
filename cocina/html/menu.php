menu.php
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
        --navbar-dark-primary: #952ef0;
        --navbar-light-primary: #ecf0f1;
        --navbar-light-secondary: #bdc3c7;
    }

    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 10px;
        background-image: url('portada2.png');
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
    max-height: 80vh; /* Ajusta esta altura según tus necesidades */
    overflow-y: auto; /* Agrega barra de desplazamiento vertical si es necesario */
    margin: 0px auto; /* Barra de desplazamiento horizontal, si es necesario */
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

    #content-container {
        margin-left: var(--navbar-width);
        padding: 20px;
        flex-grow: 1;
    }

    /* Styles for Docente2 page */
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
    max-width: 1700px;
    background: #fff;
    width: 50%;
    padding: 25px 40px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-height: 80vh; /* Ajusta esta altura según tus necesidades */
    overflow-y: auto; /* Agrega barra de desplazamiento vertical si es necesario */
    margin: 50px auto; /* Añade margen superior para separarlo del menú */
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
    padding: 20px 20px; /* Ajusta el padding */
    width: 80%; /* Reduce el ancho del formulario */
    max-width: 500px; /* Establece un ancho máximo */
    margin: 50px auto; /* Añade margen superior para separarlo del menú */
    border-radius: 8px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
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

    /* DataTables Styles */
    .dataTables_wrapper select,
    .dataTables_wrapper .dataTables_filter input {
        color: #4a5568;
        padding-left: 1rem;
        padding-right: 1rem;
        padding-top: .5rem;
        padding-bottom: .5rem;
        line-height: 1.25;
        border-width: 2px;
        border-radius: .25rem;
        border-color: #edf2f7;
        background-color: #edf2f7;
    }

    table.dataTable.hover tbody tr:hover,
    table.dataTable.display tbody tr:hover {
        background-color: #ebf4ff;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        font-weight: 700;
        border-radius: .25rem;
        border: 1px solid transparent;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        color: #fff !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .08), 0 1px 2px 0 rgba(0, 0, 0, .12);
        font-weight: 700;
        border-radius: .25rem;
        background: #ed8936 !important;
        border: 1px solid transparent;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        color: #fff !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .08), 0 1px 2px 0 rgba(0, 0, 0, .12);
        font-weight: 700;
        border-radius: .25rem;
        background: #ed8936 !important;
        border: 1px solid transparent;
    }

    table.dataTable.no-footer {
        border-bottom: 1px solid #e2e8f0;
        margin-top: 0.75em;
        margin-bottom: 0.75em;
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
            <a class="nav-button" href="crud_usuarios.php">
                <i class="fa fa-users"></i>
                <span class="menu-text">Usuarios</span>
            </a>
            <a class="nav-button" href="docente.php">
                <i class="fa fa-chalkboard-teacher"></i>
                <span class="menu-text">Instructores</span>
            </a>
            <a class="nav-button" href="bajas.php">
                <i class="fa fa-times-circle"></i>
                <span class="menu-text">Bajas</span>
            </a>
            <a class="nav-button" href="elementos.php">
                <i class="fa fa-cubes"></i>
                <span class="menu-text">Elementos</span>
            </a>
            <a class="nav-button" href="funcionarios.php">
                <i class="fa fa-briefcase"></i>
                <span class="menu-text">Funcionarios</span>
            </a>
            <a class="nav-button" href="ingreso_elementos.php">
                <i class="fa fa-boxes"></i>
                <span class="menu-text">Ingreso de elementos</span>
            </a>
            <a class="nav-button" href="inventario_actual.php">
                <i class="fa fa-warehouse"></i>
                <span class="menu-text">Inventario</span>
            </a>
            <a class="nav-button" href="requisicion.php">
                <i class="fa fa-file-alt"></i>
                <span class="menu-text">Requisición</span>
            </a>
            <a class="nav-button" href="traspaso.php">
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
