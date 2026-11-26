<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['rol'] != 'Admin') {
    header("Location: ../view/dashboard.php");
    exit();
}

include('conexionDB.php');
$con = conection();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $sql = "DELETE FROM usuarios WHERE id_user = '$id'";
    mysqli_query($con, $sql);
}

header("Location: ../view/usuarios.php");
exit();
?>