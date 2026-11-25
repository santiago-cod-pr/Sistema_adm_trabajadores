<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['rol'] != 'Admin') {
    header("Location: dashboard.php");
    exit();
}

include('../model/conexionDB.php');
$con = conection();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id_user = $id";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($query);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-secondary text-white shadow">
                    <div class="card-header bg-warning text-dark fw-bold">
                        Actualizar Usuario (ID: <?= $row['id_user'] ?>)
                    </div>
                    <div class="card-body">
                        <form method="POST" action="../model/ModeloUsuarioActualizar.php">
                            <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">

                            <div class="mb-3">
                                <label class="form-label">Nombre Completo</label>
                                <input type="text" name="nombre" class="form-control" value="<?= $row['nombre'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Correo Electrónico</label>
                                <input type="email" name="email" class="form-control" value="<?= $row['email'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="text" name="pw" class="form-control" value="<?= $row['password'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Rol / Nivel de Acceso</label>
                                <select name="rol" class="form-select" required>
                                    <option value="Admin" <?= ($row['rol'] == 'Admin') ? 'selected' : '' ?>>Admin</option>
                                    <option value="Supervisor" <?= ($row['rol'] == 'Supervisor') ? 'selected' : '' ?>>Supervisor</option>
                                    <option value="Trabajador" <?= ($row['rol'] == 'Trabajador') ? 'selected' : '' ?>>Trabajador</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="usuarios.php" class="btn btn-outline-light">Cancelar</a>
                                <button type="submit" class="btn btn-warning fw-bold">Actualizar Usuario</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>