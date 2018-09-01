<?php
class credito{
    public static function crearCredito($interes,$monto){
        $conBD = new conexion();
        $usuario = $_SESSION['usuario'];
        $sql = "INSERT INTO credito (ESTADO,INTERES,MONTO,USUARIO) VALUES ('PENDIENTE',$interes,$monto,$usuario)";
        return $conBD->ejecutarconsulta($sql);
    }
}
?>
