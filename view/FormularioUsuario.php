<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['rol'] != 'Admin') {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-secondary text-white shadow">
                    <div class="card-header bg-primary text-white fw-bold">
                        Registrar Nuevo Usuario de Acceso
                    </div>
                    <div class="card-body">
                        <form method="POST" action="../model/ModeloUsuarioAlta.php">
                            <div class="mb-3">