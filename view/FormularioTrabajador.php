<?php
require_once __DIR__ . '/../modelo/conexionDB.php';
$con = conection();

$departamentos = [];
$sqlDeptos = "SELECT id_depto, nombre_depto FROM departamentos ORDER BY nombre_depto ASC";
$resDeptos = mysqli_query($con, $sqlDeptos);
if ($resDeptos) {
    while ($fila = mysqli_fetch_assoc($resDeptos)) {
        $departamentos[] = $fila;
    }
}
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Trabajador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-secondary text-white shadow">
                    <div class="card-body p-4">
                        <h3 class="mb-4 fw-bold">Registrar Trabajador</h3>

                        <form method="POST" action="../modelo/ModeloTrabajadorAlta.php">
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Apellido</label>
                                <input type="text" name="apellido" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Puesto</label>
                                <input type="text" name="puesto" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Salario</label>
                                <input type="number" step="0.01" min="0" name="salario" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Departamento</label>
                                <select name="id_depto" class="form-select" required>
                                    <option value="">Selecciona un departamento</option>
                                    <?php foreach ($departamentos as $depto): ?>
                                        <option value="<?= (int) $depto['id_depto'] ?>">
                                            <?= htmlspecialchars($depto['nombre_depto'], ENT_QUOTES, 'UTF-8') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="dashboard.php" class="btn btn-outline-light">Volver</a>
                                <button type="submit" class="btn btn-primary fw-bold">Guardar Trabajador</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
