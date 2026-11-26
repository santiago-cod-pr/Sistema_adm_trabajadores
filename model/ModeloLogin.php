<?php
session_start();
include('conexionDB.php');
include('../controller/ClassUsuario.php');
$con = conection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $pw    = $_POST['pw'] ?? '';

    $usuarioObj = new UsuarioP($email, $pw);
    $usuario = $usuarioObj->login($con);

    if ($usuario) {
        $_SESSION['id_user'] = $usuario['id_user'];
        $_SESSION['nombre']  = $usuario['nombre'];
        $_SESSION['rol']     = $usuario['rol'];

        if ($usuario['rol'] === 'Trabajador') {
            header('Location: ../view/panel_trabajador.php');
        } else {
            header('Location: ../view/dashboard.php');
        }
        exit();
    } else {
        header('Location: ../index.php?error=1');
        exit();
    }
}

header('Location: ../index.php');
exit();
?>