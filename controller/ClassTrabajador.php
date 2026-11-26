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

    public function alta($con)
    {
        $nombre   = mysqli_real_escape_string($con, $this->nombre);
        $apellido = mysqli_real_escape_string($con, $this->apellido);
        $puesto   = mysqli_real_escape_string($con, $this->puesto);
        $salario  = (float) $this->salario;
        $id_depto = (int) $this->id_depto;

        $sql = "INSERT INTO trabajadores (nombre, apellido, puesto, salario, id_depto) 
                VALUES ('$nombre', '$apellido', '$puesto', '$salario', '$id_depto')";
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
    }

    public function actualizar($con, $id)
    {
        $id_limpio = (int) $id;
        $nombre    = mysqli_real_escape_string($con, $this->nombre);
        $apellido  = mysqli_real_escape_string($con, $this->apellido);
        $puesto    = mysqli_real_escape_string($con, $this->puesto);
        $salario   = (float) $this->salario;
        $id_depto  = (int) $this->id_depto;

        $sql = "UPDATE trabajadores 
                SET nombre = '$nombre', apellido = '$apellido', puesto = '$puesto', salario = '$salario', id_depto = '$id_depto' 
                WHERE id_trabajador = $id_limpio";
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
    }

    public function eliminar($con, $id)
    {
        $id_limpio = (int) $id;
        $sql = "DELETE FROM trabajadores WHERE id_trabajador = $id_limpio";
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
    }
}
?>