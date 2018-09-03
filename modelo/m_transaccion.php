<?php
include_once "m_conexion.php";
class transaccion{
    public static function crearTransaccionConsignacion($monto,$c_destino){
        $conBD = new conexion();
        $c_origen=$_SESSION['id_ahorro'];
        $sql = "INSERT INTO transaccion (MONTO,TIPO,FECHA,C_ORIGEN,C_DESTINO) VALUES ('$monto','CONSIGNACION',CURDATE(),'$c_origen','$c_destino')";
        return $conBD->ejecutarconsulta($sql);
    }

    public static function consignarC_ahorro($c_origen,$c_destino,$monto,$banco){
        $conBD = new conexion();
        $sql = "INSERT INTO transaccion (MONTO,TIPO,FECHA,C_ORIGEN,C_DESTINO,BANCO) VALUES ('$monto','CONSIGNACION',CURDATE(),$c_origen,$c_destino,'$banco')";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function crearTransaccionPagoTCredito($monto,$c_destino){
        $conBD = new conexion();
        $c_origen=$_SESSION['id_ahorro'];
        $sql = "INSERT INTO transaccion (MONTO,TIPO,FECHA,C_ORIGEN,C_DESTINO) VALUES ('$monto','PAGOTARJETA',CURDATE(),'$c_origen','$c_destino')";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function crearTransaccionPagoCredito($monto,$c_destino){
        $conBD = new conexion();
        $c_origen=$_SESSION['id_ahorro'];
        $sql = "INSERT INTO transaccion (MONTO,TIPO,FECHA,C_ORIGEN,C_DESTINO) VALUES ('$monto','PAGOCREDITO',CURDATE(),'$c_origen','$c_destino')";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function t_pagoCredito($monto,$c_destino,$c_origen,$banco){
        $conBD = new conexion();
        $sql = "INSERT INTO transaccion (MONTO,TIPO,FECHA,C_ORIGEN,C_DESTINO,BANCO) VALUES ('$monto','PAGOCREDITO',CURDATE(),'$c_origen','$c_destino','$banco')";
        return $conBD->ejecutarconsulta($sql);
    }

    public static function crearTransaccionCompra($monto,$cuotas){
        $conBD = new conexion();
        $c_origen=$_SESSION['id_credito'];
        $sql = "INSERT INTO transaccion (MONTO,TIPO,FECHA,C_ORIGEN,CUOTAS) VALUES ('$monto','COMPRA',CURDATE(),'$c_origen',$cuotas)";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function buscarTransaccionVisitante($idcredito_destino){
        $conBD = new conexion();
        $sql ="SELECT * FROM `transaccion` WHERE TIPO = 'PAGOCREDITO' AND C_DESTINO = $idcredito_destino";
        return $conBD->ejecutarconsulta($sql);
    }

}
?>
