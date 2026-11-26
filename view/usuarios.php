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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../SRC/css/style.css">
</head>
<body class="bg-dark text-white">

    <nav class="navbar navbar-expand-lg border-bottom mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php">Empresa RRHH</a>
            <div class="d-flex align-items-center gap-2">
                <a href="dashboard.php" class="btn">Volver a Trabajadores</a>
                <a href="../model/logout.php" class="btn">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="mb-0">Cuentas de Acceso al Sistema</h2>
                <p class="mb-0">Total de usuarios: <span><?= $total; ?></span></p>
            </div>
            <div>
                <a href="FormularioUsuario.php" class="btn-solid theme-info">+ Nuevo Usuario</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
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
                        <td><?= htmlspecialchars($row['nombre']) ?></td>
                        <td><?= htmlspecialchars($row['apellido'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><span><?= htmlspecialchars($row['rol']) ?></span></td>
                        <td><?= htmlspecialchars($row['password']) ?></td>
                        <td class="text-center">
                            <a href="FormularioUsuario.php?id=<?= $row['id_user'] ?>" class="btn btn-sm">Editar</a>
                            <a onclick="return confirm('¿Eliminar este usuario del sistema?')"
                               href="../model/ModeloUsuarioEliminar.php?id=<?= $row['id_user'] ?>"
                               class="btn btn-sm">Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../controller/ClassForm.js"></script>
    <script src="../controller/ClassUser.js"></script>
</body>
</html>