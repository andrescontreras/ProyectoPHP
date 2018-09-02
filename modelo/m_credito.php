<?php
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
}
?>
