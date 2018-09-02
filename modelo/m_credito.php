<?php
include_once "../modelo/m_conexion.php";
class credito{
    public static function crearCredito($interes,$monto){
        $conBD = new conexion();
        $usuario = $_SESSION['usuario'];
        $sql = "INSERT INTO credito (ESTADO,INTERES,MONTO,USUARIO) VALUES ('PENDIENTE',$interes,$monto,$usuario)";
        return $conBD->ejecutarconsulta($sql);
    }

    public static function getVisitantes()
    {
        $conBD = new conexion();
        $sql = "SELECT * FROM credito WHERE USUARIO NOT IN (SELECT idusuario from USUARIO)";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function obtenerCreditosxUsuario(){
        $conBD = new conexion();
        $id_usu=$_SESSION['usuario'];
        $sql = "SELECT * FROM credito WHERE USUARIO = $id_usu";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function allCredito(){
        $conBD = new conexion();
        $sql ="SELECT * FROM credito";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function disminuir_monto($monto,$id_Credito){
        $conBD = new conexion();
        $sql = "UPDATE credito SET MONTO = MONTO - $monto WHERE IDCREDITO =$id_Credito";

    }
    public static function getCreditosCliente($id_usuario){
        $conBD = new conexion();
        $sql = "SELECT * FROM credito WHERE usuario = $id_usuario ";

        return $conBD->ejecutarconsulta($sql);
    }
}
?>
