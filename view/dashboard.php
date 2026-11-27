<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../index.php");
    exit();
}

if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'Trabajador') {
    header("Location: panel_trabajador.php");
    exit();
}

require_once __DIR__ . '/../model/conexionDB.php';
$con = conection();
$sql = "SELECT t.id_trabajador, t.nombre, t.apellido, t.puesto, t.salario, t.id_depto,
               d.nombre_depto, d.ubicacion
        FROM trabajadores t
        INNER JOIN departamentos d ON t.id_depto = d.id_depto
        ORDER BY t.id_trabajador ASC";

$resultado = mysqli_query($con, $sql);
$total_trabajadores = $resultado ? mysqli_num_rows($resultado) : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Panel Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../SRC/css/style.css">
</head>
<body class="bg-dark text-white">

<nav class="navbar navbar-expand-lg border-bottom mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-white" href="dashboard.php">Empresa RRHH</a>
        <div class="d-flex align-items-center gap-2">
            <span class="me-2 text-light">
                <?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Usuario'); ?>
                <span class="badge bg-secondary"><?php echo htmlspecialchars($_SESSION['rol'] ?? ''); ?></span>
            </span>
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'Admin'): ?>
                <a href="usuarios.php" class="btn btn-outline-light btn-sm">Usuarios</a>
            <?php endif; ?>
            <a href="../model/logout.php" class="btn btn-outline-danger btn-sm">Cerrar Sesión</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="mb-0">Panel Principal de Trabajadores</h2>
            <p class="mb-0 text-secondary">Total de trabajadores: <span><?php echo $total_trabajadores; ?></span></p>
        </div>
        <a href="FormularioTrabajador.php" class="btn btn-primary">+ Nuevo Trabajador</a>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Puesto</th>
                    <th>Salario</th>
                    <th>Departamento</th>
                    <th>Ubicacion</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado && $total_trabajadores > 0): ?>
                    <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                            <td><?php echo (int)$fila['id_trabajador']; ?></td>
                            <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($fila['apellido']); ?></td>
                            <td><?php echo htmlspecialchars($fila['puesto']); ?></td>
                            <td>$<?php echo number_format((float)$fila['salario'], 2); ?></td>
                            <td><?php echo htmlspecialchars($fila['nombre_depto']); ?></td>
                            <td><?php echo htmlspecialchars($fila['ubicacion']); ?></td>
                            <td class="text-center">
                                <a href="FormularioTrabajadorActualizar.php?id=<?php echo (int)$fila['id_trabajador']; ?>"
                                   class="btn btn-warning btn-sm">Editar</a>
                                <a href="../model/ModeloTrabajadorEliminar.php?id=<?php echo (int)$fila['id_trabajador']; ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('¿Deseas eliminar a <?php echo htmlspecialchars(addslashes($fila['nombre'] . ' ' . $fila['apellido'])); ?>?');">
                                   Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-4">No hay trabajadores registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../controller/ClassForm.js"></script>
<script src="../controller/ClassUser.js"></script>
<?php mysqli_close($con); ?>
</body>
</html>