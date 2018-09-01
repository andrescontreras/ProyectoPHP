<?php
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
            $sql ="SELECT * FROM c_ahorro WHERE Owner=".$_COOKIE["usuario"];
            return $conBD->ejecutarconsulta($sql);
    }
    public static function getDatosUsuarioxTarjetaCredito()
    {
            $conBD = new conexion();
            $sql ="SELECT * FROM tarjeta_c WHERE Owner=".$_COOKIE["usuario"];
            return $conBD->ejecutarconsulta($sql);
    }
}
?>