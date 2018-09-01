<?php
include("modelo/m_config.php");

class conexion
{
    var $con; // conexion de la base de datos
    function conexion()
    {
    }

    public static function conectarBD()
    {

    }

    public static function desconectarDB()
    {
        mysql_close($this->con);
    }

    function ejecutarconsulta($sql)
    {
        $this->con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
        if (mysqli_connect_errno()) {
            echo "Error en la conexión: " . mysqli_connect_error();
        }
        else{
            echo "correcto";
        }
        $consulta = mysqli_query($this->con, $sql);
        
        mysqli_close($this->con);
        return $consulta;
    }
}

?>