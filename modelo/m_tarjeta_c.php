<?php
include_once "../modelo/m_conexion.php";
class tarjeta_c {

    public static function crearTCredito($id_cuenta){
        $conBD = new conexion();
        $sql = "INSERT INTO tarjeta_c (USUARIO,C_AHORRO,ESTADO) VALUES ("."'".$_SESSION["usuario"]."'".",$id_cuenta,'PENDIENTE')";
        return $conBD->ejecutarconsulta($sql);
    }

    public static function getTarjetas_cCliente($id_usuario){
        $conBD = new conexion();
        $sql = "SELECT * FROM tarjeta_c WHERE usuario = $id_usuario ";
        return $conBD->ejecutarconsulta($sql);
    }
}
?>