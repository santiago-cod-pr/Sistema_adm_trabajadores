<?php
class Trabajador
{
    private $id_trabajador;
    private $nombre;
    private $apellido;
    private $puesto;
    private $salario;
    private $id_depto;

    public function __construct($nombre, $apellido, $puesto, $salario, $id_depto, $id_trabajador = null)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->puesto = $puesto;
        $this->salario = $salario;
        $this->id_depto = $id_depto;
        $this->id_trabajador = $id_trabajador;
    }

    public function alta()
    {
        include('../model/conexionDB.php');
        $con = conection();

        $sql = "INSERT INTO trabajadores (nombre, apellido, puesto, salario, id_depto) 
                VALUES ('$this->nombre', '$this->apellido', '$this->puesto', '$this->salario', '$this->id_depto')";
        $query = mysqli_query($con, $sql);

        if ($query) {
            echo "
            <script>
                alert('Trabajador registrado exitosamente');
                window.location.href = '../view/dashboard.php';
            </script>";
        } else {
            echo "Error al registrar: " . mysqli_error($con);
        }
        mysqli_close($con);
    }

    public function actualizar($id)
    {
        include('../model/conexionDB.php');
        $con = conection();

        $sql = "UPDATE trabajadores 
                SET nombre = '$this->nombre', apellido = '$this->apellido', puesto = '$this->puesto', salario = '$this->salario', id_depto = '$this->id_depto' 
                WHERE id_trabajador = $id";
        $query = mysqli_query($con, $sql);

        if ($query) {
            echo "
            <script>
                alert('Datos del trabajador actualizados');
                window.location.href = '../view/dashboard.php';
            </script>";
        } else {
            echo "Error al actualizar: " . mysqli_error($con);
        }
        mysqli_close($con);
    }

    public function eliminar($id)
    {
        include('../model/conexionDB.php');
        $con = conection();

        $sql = "DELETE FROM trabajadores WHERE id_trabajador = $id";
        $query = mysqli_query($con, $sql);

        if ($query) {
            echo "
            <script>
                alert('Trabajador eliminado');
                window.location.href = '../view/dashboard.php';
            </script>";
        } else {
            echo "Error al eliminar: " . mysqli_error($con);
        }
        mysqli_close($con);
    }
}
?>