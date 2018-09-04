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
            echo $this->usuario[2];
            if (password_verify($_POST['clave'], $this->usuario[2])) {
                echo "CORRECTO";
            } else {
                echo "INCORRECTO";
            }
            echo  "ESSSS:".$this->usuario[4];
            if($this->usuario[3] == 'ADMIN')
            {
                echo "ES ADNIN";
            }

            if($this->usuario[4] == 'CLIENTE')
            {
                echo "ES CLIENTE";
            }
            if ($this->usuario[4] == 'ADMIN' and password_verify($_POST['clave'], $this->usuario[2])) {

                session_start();
                $_SESSION["id_admin"] = $this->usuario[0];
                header("Location: v_adminPrincipal.php");
            } elseif ($this->usuario[3] == 'CLIENTE' and password_verify($_POST['clave'], $this->usuario[2])) {
                session_start();
                $_SESSION["nombre_cliente"] = $this->usuario[1];
                header("Location: v_clientePrincipal.php");

            } else {
                echo "<div class='alert alert-danger' role='alert'>
                Usuario o contraseña incorrectos pass
              </div>";

            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>
                Usuario o contraseña incorrectos
              </div>";
        }

    }
    public function registrarse()
    {
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        if (!empty($usuario) && !empty($clave)) {
            $consulta = m_usuario::getUsuario($_POST['usuario']);
            $str_datos = "";
            if ($consulta->num_rows < 1) {
                $clave1 = password_hash($clave, PASSWORD_DEFAULT);
                $consulta = m_usuario::setUsuario($usuario, $clave1);
                echo "Usuario creado";
                echo "<div class='alert alert-success' role='alert'>
                Usuario creado
              </div>";
            } else {
                echo "<div class='alert alert-danger' role='alert'>
                    El nombre de usuario ya existe
                  </div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>
            Los campos no pueden estar vacios
          </div>";
        }


    }
}
?>