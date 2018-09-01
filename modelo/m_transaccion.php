<?php
class transaccion{
    public static function crearTransaccionConsignacion($monto,$tipo,$c_origen,$c_destino){
        $conBD = new conexion();
        $sql = "INSERT INTO transaccion (MONTO,TIPO,FECHA,C_ORIGEN,C_DESTINO) VALUES ('$monto','CONSIGNACION',CURDATE(),'$c_origen','$c_destino')";
        return $conBD->ejecutarconsulta($sql);
    }

}
?>
