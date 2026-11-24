<?php
function conection()
{
    $host = "localhost";
    $user = "root";
    $pass = "";
    $bd = "empresa_db";

    $con = mysqli_connect($host, $user, $pass, $bd);
    if (!$con) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    return $con;
}
?>
