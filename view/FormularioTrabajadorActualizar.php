<?php
require_once __DIR__ . '/../modelo/conexionDB.php';
$con = conection();

$id = (int) ($_GET['id'] ?? 0);
$res = mysqli_query($con, "SELECT * FROM trabajadores WHERE id_trabajador = $id");
$t = mysqli_fetch_assoc($res);
$deptos = mysqli_query($con, "SELECT id_depto, nombre_depto FROM departamentos ORDER BY nombre_depto");

if (!$t) {
    die("Trabajador no encontrado.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Trabajador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white py-5">
<div class="container" style="max-width: 500px;">
    <h3 class="mb-4">Actualizar Trabajador</h3>
    <form method="POST" action="../modelo/ModeloTrabajadorActualizar.php">
        <input type="hidden" name="id_trabajador" value="<?= $t['id_trabajador'] ?>">
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($t['nombre']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Apellido</label>
            <input type="text" name="apellido" class="form-control" value="<?= htmlspecialchars($t['apellido']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Puesto</label>
            <input type="text" name="puesto" class="form-control" value="<?= htmlspecialchars($t['puesto']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Salario</label>
            <input type="number" step="0.01" name="salario" class="form-control" value="<?= $t['salario'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Departamento</label>
            <select name="id_depto" class="form-select" required>
                <?php while ($d = mysqli_fetch_assoc($deptos)): ?>
                    <option value="<?= $d['id_depto'] ?>" <?= $d['id_depto'] == $t['id_depto'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($d['nombre_depto']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="dashboard.php" class="btn btn-outline-light">Volver</a>
    </form>
</div>
<?php mysqli_close($con); ?>
</body>
</html>
