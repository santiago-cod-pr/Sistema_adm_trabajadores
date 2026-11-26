<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Trabajador') {
    header("Location: dashboard.php");
    exit();
}

require_once __DIR__ . '/../model/conexionDB.php';
$con = conexion();

$nombre_sesion = mysqli_real_escape_string($con, $_SESSION['nombre'] ?? '');

$sql = "SELECT t.id_trabajador, t.nombre, t.apellido, t.puesto, t.salario,
               d.nombre_depto, d.ubicacion
        FROM trabajadores t
        INNER JOIN departamentos d ON t.id_depto = d.id_depto
        WHERE t.nombre = '$nombre_sesion'
        LIMIT 1";

$res = mysqli_query($con, $sql);
$trabajador = ($res && mysqli_num_rows($res) > 0) ? mysqli_fetch_assoc($res) : null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Trabajador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../SRC/css/style.css">
</head>
<body class="bg-dark text-white">

<nav class="navbar navbar-expand-lg border-bottom mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-white" href="panel_trabajador.php">Portal del Trabajador</a>
        <div class="d-flex align-items-center gap-2">
            <span class="me-2 text-light"><?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Trabajador'); ?></span>
            <a href="../model/logout.php" class="btn btn-outline-danger btn-sm">Cerrar Sesión</a>
        </div>
    </div>
</nav>

<div class="container py-4">
    <div class="card bg-secondary text-white shadow mx-auto" style="max-width: 600px;">
        <div class="card-header fw-bold">
            Mi Perfil Laboral
        </div>
        <div class="card-body">
            <?php if ($trabajador): ?>
                <p><strong>Nombre completo:</strong> <?php echo htmlspecialchars($trabajador['nombre'] . ' ' . $trabajador['apellido']); ?></p>
                <p><strong>Puesto:</strong> <?php echo htmlspecialchars($trabajador['puesto']); ?></p>
                <p><strong>Salario:</strong> $<?php echo number_format((float)$trabajador['salario'], 2); ?></p>
                <p><strong>Departamento:</strong> <?php echo htmlspecialchars($trabajador['nombre_depto']); ?></p>
                <p class="mb-0"><strong>Ubicación:</strong> <?php echo htmlspecialchars($trabajador['ubicacion']); ?></p>
            <?php else: ?>
                <div class="alert alert-info text-dark mb-0">
                    Sesión iniciada como <strong><?php echo htmlspecialchars($_SESSION['nombre'] ?? ''); ?></strong>, pero aún no hay un registro en la tabla de trabajadores con ese nombre.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="../controller/ClassForm.js"></script>
<script src="../controller/ClassUser.js"></script>
<?php mysqli_close($con); ?>
</body>
</html>