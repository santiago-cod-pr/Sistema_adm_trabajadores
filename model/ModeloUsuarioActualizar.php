<?php
include("../controller/ClassUsuario.php");

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $id = $_POST['id_user'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $pw = $_POST['pw'];
    $rol = $_POST['rol'];

    $user = new Usuario($email, $pw, $nombre, $rol);
    $user->actualizar($id);
}
?>