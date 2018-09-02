<?php
include_once "../modelo/m_conexion.php";
class transaccion{
    public static function crearTransaccionConsignacion($monto,$c_destino){
        $conBD = new conexion();
        $c_origen=$_SESSION['id_ahorro'];
        $sql = "INSERT INTO transaccion (MONTO,TIPO,FECHA,C_ORIGEN,C_DESTINO) VALUES ('$monto','CONSIGNACION',CURDATE(),'$c_origen','$c_destino')";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function crearTransaccionPagoTCredito($monto,$c_destino){
        $conBD = new conexion($monto,$c_destino);
        $c_origen=$_SESSION['id_ahorro'];
        $sql = "INSERT INTO transaccion (MONTO,TIPO,FECHA,C_ORIGEN,C_DESTINO) VALUES ('$monto','PAGOTARJETA',CURDATE(),'$c_origen','$c_destino')";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function crearTransaccionPagoCredito($monto,$c_destino){
        $conBD = new conexion($monto,$c_destino);
        $c_origen=$_SESSION['id_ahorro'];
        $sql = "INSERT INTO transaccion (MONTO,TIPO,FECHA,C_ORIGEN,C_DESTINO) VALUES ('$monto','PAGOCREDITO',CURDATE(),'$c_origen','$c_destino')";
        return $conBD->ejecutarconsulta($sql);
    }

}
?>
