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
    <div class="container mt-4">
        <h2><?= $esEdicion ? 'Actualizar Usuario #' . htmlspecialchars($usuario['id_user']) : 'Registrar Nuevo Usuario' ?></h2>
        <a href="usuarios.php" class="btn mb-3">Volver a Usuarios</a>

        <form method="POST" action="<?= $esEdicion ? '../model/ModeloUsuarioActualizar.php' : '../model/ModeloUsuarioAlta.php' ?>">
            <?php if ($esEdicion) { ?>
                <input type="hidden" name="id_user" value="<?= htmlspecialchars($usuario['id_user']) ?>">
            <?php } ?>

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($usuario['email']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select name="rol" class="form-select">
                    <option value="Admin" <?= $usuario['rol'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="Supervisor" <?= $usuario['rol'] == 'Supervisor' ? 'selected' : '' ?>>Supervisor</option>
                    <option value="Trabajador" <?= $usuario['rol'] == 'Trabajador' ? 'selected' : '' ?>>Trabajador</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="text" name="password" class="form-control" value="<?= htmlspecialchars($usuario['password']) ?>" required>
            </div>

            <button type="submit" class="btn">
                <?= $esEdicion ? 'Guardar Cambios' : 'Crear Usuario' ?>
            </button>
        </form>
    </div>

    <script src="../controller/ClassForm.js"></script>
    <script src="../controller/ClassUser.js"></script>
</body>
</html>