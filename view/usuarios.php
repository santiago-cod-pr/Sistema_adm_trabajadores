<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['rol'] != 'Admin') {
    header("Location: dashboard.php");
    exit();
}

include('../model/conexionDB.php');
$con = conection();

$sql = "SELECT * FROM usuarios";
$query = mysqli_query($con, $sql);
$total = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios del Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

    <nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-secondary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php">Empresa RRHH</a>
            <div class="d-flex align-items-center gap-3">
                <a href="dashboard.php" class="btn btn-outline-light btn-sm">Volver a Trabajadores</a>
                <a href="../model/logout.php" class="btn btn-outline-danger btn-sm">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="mb-0">Cuentas de Acceso al Sistema</h2>
                <p class="text-secondary mb-0">Total de usuarios: <span class="badge bg-info text-dark"><?= $total; ?></span></p>
            </div>
            <div>
                <a href="FormularioUsuario.php" class="btn btn-primary fw-bold">+ Nuevo Usuario</a>
            </div>
        </div>

        <div class="table-responsive shadow rounded">
            <table class="table table-dark table-striped table-hover align-middle mb-0">
                <thead class="table-info text-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol / Cargo</th>
                        <th>Contraseña</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td><?= $row['id_user'] ?></td>
                        <td><?= $row['nombre'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><span class="badge bg-warning text-dark"><?= $row['rol'] ?></span></td>
                        <td><?= $row['password'] ?></td>
                        <td class="text-center">
                            <a href="FormularioUsuarioActualizar.php?id=<?= $row['id_user'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a onclick="return confirm('¿Eliminar este usuario del sistema?')" 
                               href="../model/ModeloUsuarioEliminar.php?id=<?= $row['id_user'] ?>" 
                               class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>