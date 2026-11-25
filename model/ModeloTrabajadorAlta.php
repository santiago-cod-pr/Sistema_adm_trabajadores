<?php
require_once __DIR__ . '/../controlador/ClassTrabajador.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre   = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $puesto   = trim($_POST['puesto'] ?? '');
    $salario  = $_POST['salario'] ?? 0;
    $id_depto = $_POST['id_depto'] ?? 0;

    if ($nombre === '' || $apellido === '' || $puesto === '' || !is_numeric($salario) || (int) $id_depto <= 0) {
        echo "<script>
            alert('Por favor completa todos los campos correctamente.');
            window.history.back();
        </script>";
        exit();
    }

    $trabajador = new Trabajador(
        $nombre,
        $apellido,
        $puesto,
        (float) $salario,
        (int) $id_depto
    );
    $trabajador->alta();
} else {
    header("Location: ../vista/FormularioTrabajador.php");
    exit();
}
