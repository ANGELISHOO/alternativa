<?php
// Establece la conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "hotel";

// Crear conexión
$con = mysqli_connect($host, $user, $password, $dbname);

// Verificar conexión
if (!$con) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$sql = "SELECT r.*, d.nombre 
        FROM requisiciones r 
        JOIN docentes d ON r.id_docente = d.id";

session_start();

// Verificar si la sesión no está iniciada
if (!isset($_SESSION['usuario'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: inicio.html");
    exit();
}

// Obtener el término de búsqueda si existe
$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
}

// Ejecutar la consulta y almacenar los resultados
$result = mysqli_query($con, $sql);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso nueva Requisición</title>
    
    <!-- Estilos de Tailwind CSS y DataTables -->
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

    <!-- Script de jsPDF y AutoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.12/jspdf.plugin.autotable.min.js"></script>
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
    max-width: 2000px; /* Mantener este valor o ajustarlo según necesites */
    background: #fff;
    width: 80%; /* Aumentar el ancho del contenedor */
    padding: 25px 40px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-height: 100vh; /* Ajusta esta altura según tus necesidades */
    overflow-y: auto; /* Agrega barra de desplazamiento vertical si es necesario */
    margin: 50px auto; /* Añade margen superior para separarlo del menú */
    margin-right: 30px; /* Añadir margen a la izquierda para moverlo más a la derecha */
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

    @media print {
    /* Ocultar todo el contenido que no quieres imprimir */
    #nav-bar, .button-container, #nav-footer {
        display: none !important;
    }

    /* Asegurarte de que la tabla se vea bien al imprimir */
    .container {
        margin: 0;
        padding: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    h2.text {
        page-break-after: avoid;
    }
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
    <div class="container">
    <h2 class="text">Ingresar requisicion</h2>
    <div class="button-container">
    </div>
    <form action="insert_requisicion.php" method="POST">
        <input type="text" name="num_requisicion" placeholder="Numero de la requisición" required>
        <select name="id_docente" id="docente" class="select" required>
            <option value="">Seleccione un docente</option>
            <?php
                $query = "SELECT * FROM docentes";
                $result = mysqli_query($con, $query) or die(mysqli_error($con));
                while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
                }
            ?>
        </select>
        <select name="id_elemento" id="elemento" class="select" required>
            <option value="">Seleccione un Elemento</option>
            <?php
                $query = "SELECT * FROM inventario";
                $result = mysqli_query($con, $query) or die(mysqli_error($con));
                while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="'.$row['id'].'">'.$row['elementos'].'</option>';
                }
            ?>
        </select>
        <input type="number" name="cantidad_requisicion" placeholder="Cantidad de elementos" required>
        <label for="elemento">fecha de la solicitud</label><br>
        <input type="date" name="fecha_solicitud" placeholder="Fecha de solicitud" required>
        <label for="elemento">fecha de Entrega</label><br>
        <input type="date" name="fecha_de_entrega" placeholder="Fecha de Entrega" required>
        <input type="number" name="grupo_encargado" placeholder="Grupo encargado" required>
        <select name="funcionario" id="funcionario" class="select" required>
            <option value="">Funcionario</option>
            <?php
                $query = "SELECT * FROM funcionario";
                $result = mysqli_query($con, $query) or die(mysqli_error($con));
                while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="'.$row['funcionario'].'">'.$row['funcionario'].'</option>';
                }
            ?>
        </select>
        <input type="text" name="evento" placeholder="Evento" required>
        <input type="text" name="observaciones" placeholder="Observaciones">
        <select name="anulada" id="anulada" class="select" required>
            <option value="">Anulada</option>
            <option value="SI">SI</option>
            <option value="NO">NO</option>
            <?php
                $query = "SELECT * FROM activo";
                $result = mysqli_query($con, $query) or die(mysqli_error($con));
                while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="'.$row['activo'].'">'.$row['activo'].'</option>';
                }
            ?>
        </select>
        <input type="submit" value="Agregar">
    </form>
    <form action="" method="GET">
        <h2 class="text">Filtrar por fecha de solicitud</h2>
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="date" name="fecha_inicio">
        <label for="fecha_fin">Fecha de fin:</label>
        <input type="date" name="fecha_fin">
        <input type="submit" value="Filtrar">
    </form>

    <h2 class="text">Requisiciones</h2>
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
        <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nº requisicion</th>
                    <th>docente</th>
                    <th>Elemento</th>
                    <th>Cantidad</th>
                    <th>Fecha Solicitud</th>
                    <th>Fecha Entrega</th>
                    <th>Grupo Encargado</th>
                    <th>Funcionario</th>
                    <th>Evento</th>
                    <th>Observaciones</th>
                    <th>Anulada</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // Obtener las fechas seleccionadas
                $fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : '';
                $fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : '';

                // Modificar la consulta SQL para filtrar por fecha de solicitud
                $sql = "
                SELECT r.*, d.nombre AS docente, e.elementos AS elemento
                FROM requisicion r
                JOIN docentes d ON r.id_docente = d.id
                JOIN inventario e ON r.id_elemento = e.id";

                // Si se seleccionaron fechas, añadir el filtro
                if (!empty($fecha_inicio) && !empty($fecha_fin)) {
                    $sql .= " WHERE r.fecha_solicitud BETWEEN '$fecha_inicio' AND '$fecha_fin'";
                }

                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['num_requisicion'] . "</td>";
                        echo "<td>" . $row['docente'] . "</td>";
                        echo "<td>" . $row['elemento'] . "</td>";
                        echo "<td>" . $row['cantidad_requisicion'] . "</td>";
                        echo "<td>" . $row['fecha_solicitud'] . "</td>";
                        echo "<td>" . $row['fecha_de_entrega'] . "</td>";
                        echo "<td>" . $row['grupo_encargado'] . "</td>";
                        echo "<td>" . $row['funcionario'] . "</td>";
                        echo "<td>" . $row['evento'] . "</td>";
                        echo "<td>" . $row['observaciones'] . "</td>";
                        echo "<td>" . $row['anulada'] . "</td>";
                        echo "<td>";
                        echo "<div class='grid-btns-crud'>";
                        echo "<div><a href='update_requisicion.php?id=".$row['id']."' class='bg-teal-500 p-1.5 rounded-[4px]'>Editar</a></div>";
                        echo "<div><a href='delete_requisicion.php?id=".$row['id']."' class='bg-rose-500 p-1.5 rounded-[4px]'>Eliminar</a></div>";
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='13'>No se encontraron requisiciones en el rango de fechas seleccionadas</td></tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
    <div>
    <button class="rounded-[9px] bg-green-500 px-4 py-[7px] font-[450] text-slate-100 hover:cursor-pointer" onclick="exportToExcel()">Exportar a Excel</button>
    <button class="rounded-[9px] bg-red-500 px-4 py-[7px] font-[450] text-slate-100 hover:cursor-pointer" onclick="exportToPDF()">Exportar a PDF</button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
function exportToExcel() {
    var table = document.getElementById('example'); 
    var excel = '<table border="1">'; 

    for (var i = 0; i < table.rows.length; i++) {
        excel += '<tr>';

        for (var j = 0; j < table.rows[i].cells.length; j++) {
            if (j === table.rows[i].cells.length - 1) {
                continue; 
            }
            excel += '<td>' + table.rows[i].cells[j].innerHTML.replace(/</g, '&lt;').replace(/>/g, '&gt;') + '</td>';
        }
        excel += '</tr>';
    }

    excel += '</table>';

    var blob = new Blob(['\uFEFF' + excel], { type: 'application/vnd.ms-excel;charset=UTF-8' });
    var link = document.createElement('a');

    link.href = URL.createObjectURL(blob);
    link.download = 'requisiciones.xls'; 

    link.click();
}

function exportToPDF() {
    const { jsPDF } = window.jspdf;
    const { autoTable } = window.jspdf;

    var doc = new jsPDF();
    var table = document.getElementById('example'); 

    var rowData = [];
    for (var i = 0; i < table.rows.length; i++) {
        var row = [];
        for (var j = 0; j < table.rows[i].cells.length; j++) {
            if (j === table.rows[i].cells.length - 1) {
                continue; 
            }
            row.push(table.rows[i].cells[j].innerText); 
        }
        rowData.push(row);
    }

    // Usar autoTable para agregar la tabla al documento PDF
    autoTable(doc, {
        head: [rowData[0]], 
        body: rowData.slice(1) 
    });

    doc.save('requisiciones.pdf'); 
}
</script>


</div>

<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<!--Datatables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true
        }).columns.adjust().responsive.recalc();
    });
</script>
</body>
</html>