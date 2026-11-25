<?php
include("../controller/ClassUsuario.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = new Usuario("", "");
    $user->eliminar($id);
}
?>