<?php
session_start();

if (!isset($_SESSION['id_user']) || (isset($_SESSION['rol']) && $_SESSION['rol'] === 'Trabajador')) {
    header("Location: ../view/dashboard.php");
    exit();
}

require_once __DIR__ . '/conexionDB.php';
require_once __DIR__ . '/../controller/ClassTrabajador.php';

if (isset($_GET['id']) && is_numeric($_GET['id']) && (int)$_GET['id'] > 0) {
    $id = (int)$_GET['id'];
    $con = conection();

    $trabajador = new Trabajador('', '', '', 0, 0, $id);
    $trabajador->eliminar($con, $id);

    mysqli_close($con);
    exit();
} else {
    header("Location: ../view/dashboard.php");
    exit();
}