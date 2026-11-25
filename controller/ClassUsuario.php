<?php
class Usuario
{
    private $id_user;
    private $nombre;
    private $email;
    private $pw;
    private $rol;

    public function __construct($email, $pw, $nombre = null, $rol = null, $id_user = null)
    {
        $this->email = $email;
        $this->pw = $pw;
        $this->nombre = $nombre;
        $this->rol = $rol;
        $this->id_user = $id_user;
    }

    public function login()
    {
        include('../model/conexionDB.php');
        $con = conection();

        $email_limpio = mysqli_real_escape_string($con, $this->email);
        $pw_limpio = mysqli_real_escape_string($con, $this->pw);

        $sql = "SELECT * FROM usuarios WHERE email = '$email_limpio' AND password = '$pw_limpio'";
        $query = mysqli_query($con, $sql);

        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);

            session_start();
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['rol'] = $row['rol'];

            if ($row['rol'] == 'Admin' || $row['rol'] == 'Supervisor') {
                header("Location: ../view/dashboard.php");
            } else {
                header("Location: ../view/panel_trabajador.php");
            }
            exit();
        } else {
            echo "
            <script>
                alert('Correo o contraseña incorrectos. Intenta de nuevo.');
                window.location.href = '../index.php';
            </script>";
            exit();
        }
        mysqli_close($con);
    }

    // El Integrante 2 agregará aquí abajo los métodos alta(), actualizar() y eliminar()
}
?>