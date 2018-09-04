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
                
                session_start();
                $_SESSION["id_admin"] = $this->usuario[0];
                header("Location: v_adminPrincipal.php");
            } elseif ($this->usuario[3] == 'CLIENTE' and $this->usuario[2] == $_POST['clave']) {
                session_start();
                $_SESSION["nombre_cliente"] = $this->usuario[1];
                header("Location: v_clientePrincipal.php");

            } else {
                echo "<div class='alert alert-danger' role='alert'>
                Usuario o contraseña incorrectos
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
        if(!empty($usuario) && !empty($clave))
        {
            $consulta = m_usuario::getUsuario($_POST['usuario']);
            $str_datos = "";
            if ($consulta->num_rows < 1) {
                $consulta = m_usuario::setUsuario($usuario,$clave);
                echo "Usuario creado";
                echo "<div class='alert alert-success' role='alert'>
                Usuario creado
              </div>";
            } else {
                echo "<div class='alert alert-danger' role='alert'>
                    El nombre de usuario ya existe
                  </div>";
            }   
        }
        else
        {
            echo "<div class='alert alert-danger' role='alert'>
            Los campos no pueden estar vacios
          </div>";
        }
        

    }
}
?>