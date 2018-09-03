<?php
  include_once "../modelo/m_conexion.php";

  class m_finMes.php
  {
    public static function crearTransaccionPagoCredito($monto,$c_origen)
    {
      $conBD = new conexion();
      $sql = "INSERT INTO TRANSACCION (MONTO, TIPO, FECHA, C_ORIGEN, CUOTAS) VALUES (".$monto.", 'PAGOCREDITO', CURDATE(), ".$c_origen.", 1 )";
      $conBD->ejecutarconsulta($sql);
    }

    public static function crearNotificacionTransaccion($texto, $u_destino)
    {
      $conBD = new conexion();
      $sql "INSERT INTO MENSAJES ( U_ORIGEN, U_DESTINO, MENSAJE, FECHA, ESTADO ) VALUES ( -1 ,".$u_destino.", '$texto', CURDATE, 1)";
      $conBD->ejecutarconsulta($sql);
    }
  }
?>
