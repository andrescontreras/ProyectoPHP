<?php
include_once "../modelo/m_conexion.php";
class compra {
    public static function crearCompra($cuotas,$monto,$descripcion){
        $conBD = new conexion();
        $id_tarjeta = $_SESSION['id_credito'];
        //echo "INSERT INTO compra (CUOTAS,MONTO,DESCRIPCION,IDTARJETA_C,PAGADO) VALUES ($cuotas,$monto,'$descripcion',$id_tarjeta,0)";
        $sql = "INSERT INTO compra (CUOTAS,MONTO,DESCRIPCION,IDTARJETA_C,PAGADO) VALUES ($cuotas,$monto,'$descripcion',$id_tarjeta,0)";
        return $conBD->ejecutarconsulta($sql);
    }
}