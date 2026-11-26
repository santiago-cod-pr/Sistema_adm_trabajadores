<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['rol'] != 'Admin') {
    header("Location: dashboard.php");
    exit();
}

include('../model/conexionDB.php');
$con = conection();

$esEdicion = false;
$usuario = [
    'id_user'  => '',
    'nombre'   => '',
    'apellido' => '',
    'email'    => '',
    'rol'      => 'Trabajador',
    'password' => ''
];

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $esEdicion = true;
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $sql = "SELECT * FROM usuarios WHERE id_user = '$id' LIMIT 1";
    $query = mysqli_query($con, $sql);
    if ($row = mysqli_fetch_assoc($query)) {
        $usuario = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $esEdicion ? 'Actualizar Usuario' : 'Nuevo Usuario' ?></title>
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
                <a href="usuarios.php" class="btn">Volver a Usuarios</a>
                <a href="../model/logout.php" class="btn">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container py-3" style="max-width: 560px;">
        <div class="card p-4 shadow">
            <h3 class="mb-1 fw-bold text-center">
                <?= $esEdicion ? 'Actualizar Usuario #' . htmlspecialchars($usuario['id_user']) : 'Registrar Nuevo Usuario' ?>
            </h3>
            <p class="text-center mb-4" style="opacity: 0.75;">
                <?= $esEdicion ? 'Modifica los datos de acceso del usuario' : 'Completa los datos para crear una cuenta de acceso' ?>
            </p>

            <form method="POST" action="<?= $esEdicion ? '../model/ModeloUsuarioActualizar.php' : '../model/ModeloUsuarioAlta.php' ?>">
                <?php if ($esEdicion) { ?>
                    <input type="hidden" name="id_user" value="<?= htmlspecialchars($usuario['id_user']) ?>">
                <?php } ?>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ej. Carlos"
                               value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Apellidos</label>
                        <input type="text" name="apellido" class="form-control" placeholder="Ej. Mendoza López"
                               value="<?= htmlspecialchars($usuario['apellido']) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" placeholder="usuario@empresa.com"
                           value="<?= htmlspecialchars($usuario['email']) ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Rol / Cargo</label>
                        <select name="rol" class="form-select w-100" required>
                            <option value="Admin" <?= $usuario['rol'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="Supervisor" <?= $usuario['rol'] == 'Supervisor' ? 'selected' : '' ?>>Supervisor</option>
                            <option value="Trabajador" <?= $usuario['rol'] == 'Trabajador' ? 'selected' : '' ?>>Trabajador</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="text" name="password" class="form-control" placeholder="********"
                               value="<?= htmlspecialchars($usuario['password']) ?>" required>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="usuarios.php" class="btn-outline theme-danger">Cancelar</a>
                    <button type="submit" class="btn-solid theme-accent">
                        <?= $esEdicion ? 'Guardar Cambios' : 'Crear Usuario' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="../controller/ClassForm.js"></script>
    <script src="../controller/ClassUser.js"></script>
</body>
</html>