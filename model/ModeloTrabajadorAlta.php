<?php
session_start();
if (!isset($_SESSION['id_user']) || (isset($_SESSION['rol']) && $_SESSION['rol'] === 'Trabajador')) {
    header("Location: ../view/dashboard.php");
    exit();
}

require_once __DIR__ . '/conexionDB.php';
require_once __DIR__ . '/../controller/ClassTrabajador.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre   = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $puesto   = trim($_POST['puesto'] ?? '');
    $salario  = $_POST['salario'] ?? 0;
    $id_depto = $_POST['id_depto'] ?? 0;

    $con = conection();
    $trabajador = new Trabajador($nombre, $apellido, $puesto, (float) $salario, (int) $id_depto);
    $trabajador->alta($con);
    mysqli_close($con);
} else {
    header("Location: ../view/dashboard.php");
    exit();
}
?>