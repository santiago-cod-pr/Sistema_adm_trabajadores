<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Personal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="SRC/css/style.css">
</head>

<?php
if (isset($_GET['error'])) {
    echo "<script>alert('DATOS INCORRECTOS - INTENTE DE NUEVO');</script>";
}
?>

<body>
    <h1 id="titulo">CONTROL DE PERSONAL</h1>

    <!-- aqui inicia el FORMULARIO -->
    <div class="card" id="contenedorform">
        <div class="card-body">
            <form method="POST" action="model/ModeloLogin.php">
                <label class="form-label">Email</label>
                <input class="form-control" name="email" placeholder="admin@empresa.com" type="email" required />

                <label class="form-label">Password</label>
                <input class="form-control" name="pw" placeholder="********" type="password" required />

                <div id="btn1">
                    <button type="submit" class="btn-solid theme-accent">Iniciar Sesion</button>
                    <button type="reset" class="btn-outline theme-danger">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    <!-- aqui termina el FORMULARIO -->
</body>

</html>