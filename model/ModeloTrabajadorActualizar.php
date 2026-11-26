<?php
session_start();
if (!isset($_SESSION['id_user']) || (isset($_SESSION['rol']) && $_SESSION['rol'] === 'Trabajador')) {
    header("Location: ../view/dashboard.php");
    exit();
}

require_once __DIR__ . '/conexionDB.php';
require_once __DIR__ . '/../controller/ClassTrabajador.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_trabajador = $_POST['id_trabajador'] ?? 0;
    $nombre        = trim($_POST['nombre'] ?? '');
    $apellido      = trim($_POST['apellido'] ?? '');
    $puesto        = trim($_POST['puesto'] ?? '');
    $salario       = $_POST['salario'] ?? 0;
    $id_depto      = $_POST['id_depto'] ?? 0;

    if ((int) $id_trabajador <= 0 || $nombre === '' || $apellido === '' || $puesto === '' || !is_numeric($salario) || (int) $id_depto <= 0) {
        echo "<script>
            alert('Datos inválidos para actualizar el trabajador.');
            window.history.back();
        </script>";
        exit();
    }

    $con = conection();
    $trabajador = new Trabajador(
        $nombre,
        $apellido,
        $puesto,
        (float) $salario,
        (int) $id_depto,
        (int) $id_trabajador
    );
    $trabajador->actualizar($con, (int) $id_trabajador);
    mysqli_close($con);
} else {
    header("Location: ../view/dashboard.php");
    exit();
}
?>