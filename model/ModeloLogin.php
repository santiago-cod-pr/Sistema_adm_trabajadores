<?php
include("../controller/ClassUsuario.php");

if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['email'], $_POST['pw'])) {
    $email = $_POST['email'];
    $pass = $_POST['pw'];

    if (empty($email) || empty($pass)) {
        echo "
        <script>
            alert('Por favor llena todos los campos');
            window.location.href = '../index.php';
        </script>";
    } else {
        $user = new Usuario($email, $pass);
        $user->login();
    }
}
?>