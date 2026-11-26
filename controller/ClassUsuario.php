<?php
class UsuarioP {
    private $id_user;
    private $nombre;
    private $email;
    private $pw;
    private $rol;

    public function __construct($email, $pw, $nombre = null, $rol = null, $id_user = null) {
        $this->email   = $email;
        $this->pw      = $pw;
        $this->nombre  = $nombre;
        $this->rol     = $rol;
        $this->id_user = $id_user;
    }

    public function login($con) {
        $email_limpio = mysqli_real_escape_string($con, $this->email);
        $pw_limpio    = mysqli_real_escape_string($con, $this->pw);

        $sql = "SELECT * FROM usuarios WHERE email = '$email_limpio' AND password = '$pw_limpio' LIMIT 1";
        $query = mysqli_query($con, $sql);

        if ($query && mysqli_num_rows($query) === 1) {
            return mysqli_fetch_assoc($query);
        }
        return false;
    }
}
?>