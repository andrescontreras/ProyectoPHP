<?php
include_once "../modelo/m_conexion.php";
class m_usuario{
    public static function getID($nom_usuario)
    {
            $conBD = new conexion();
            $sql ="SELECT * FROM usuario WHERE USUARIO ='".$nom_usuario."'";
            return $conBD->ejecutarconsulta($sql);
    }
    public static function getDatosUsuarioxCuentaAhorro()
    {
            $conBD = new conexion();
            //echo "SELECT * FROM c_ahorro WHERE USUARIO=".$_SESSION["usuario"]."<br>";
            $sql ="SELECT * FROM c_ahorro WHERE USUARIO=".$_SESSION["usuario"];
            return $conBD->ejecutarconsulta($sql);
    }
    public static function getDatosUsuarioxTarjetaCredito()
    {
            $conBD = new conexion();
            $sql ="SELECT * FROM tarjeta_c WHERE USUARIO=".$_SESSION["usuario"];
            return $conBD->ejecutarconsulta($sql);
    }
    public static function obtenerNombreUsuario(){
        $conBD = new conexion();
        $sql ="SELECT * FROM usuario WHERE IDUSUARIO ='".$_SESSION["usuario"]."'";
        return $conBD->ejecutarconsulta($sql);
    }

    public static function getUsuarios()
    {
        $conBD = new conexion();
        $sql = "SELECT * FROM usuario";
        return $conBD->ejecutarconsulta($sql);
    }

}
?>