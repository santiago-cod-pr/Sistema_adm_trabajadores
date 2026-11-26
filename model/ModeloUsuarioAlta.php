<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['rol'] != 'Admin') {
    header("Location: ../view/dashboard.php");
    exit();
}

include('conexionDB.php');
$con = conection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre   = mysqli_real_escape_string($con, $_POST['nombre'] ?? '');
    $email    = mysqli_real_escape_string($con, $_POST['email'] ?? '');
    $rol      = mysqli_real_escape_string($con, $_POST['rol'] ?? 'Trabajador');
    $password = mysqli_real_escape_string($con, $_POST['password'] ?? '');

    $sql = "INSERT INTO usuarios (nombre, email, rol, password)
            VALUES ('$nombre', '$email', '$rol', '$password')";
    mysqli_query($con, $sql);
}

header("Location: ../view/usuarios.php");
exit();
?>