<?php
include_once "../modelo/m_usuario.php";
class c_login
{
    public $usuario;
    public $contraseña;
    public function __construct()
    {

    }
    public function iniciar()
    {
        echo $_POST['usuario'];
        $consulta = m_usuario::getUsuario($_POST['usuario']);
        $str_datos = "";
        if ($consulta->num_rows >= 1) {
            while ($fila = mysqli_fetch_array($consulta)) {
                $this->usuario = $fila;
            }
            echo "ID: " . $this->usuario[0];
            if ($this->usuario[3] == 'ADMIN' and $this->usuario[2] == $_POST['clave']) {
                echo "444444444444545";
                session_start();
                $_SESSION["id_admin"] = $value;
                header("Location: v_adminPrincipal.php");
            } elseif ($this->usuario[3] == 'CLIENTE' and $this->usuario[2] == $_POST['clave']) {
                echo "zzzzzzzzzzzzzz";
                session_start();
                $_SESSION["nombre_cliente"] = $value;
                header("Location: v_clientePrincipal.php");

            } else {
                echo "verifique las credenciales";
            }
        } else {
            echo " no existe";
        }

    }
}
?>