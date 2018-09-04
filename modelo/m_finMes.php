<?php
  include_once "../modelo/m_conexion.php";

  class m_finMes
  {
    //Registra la transaccion de pago de fin de mes
    public static function crearTransaccionPagoCredito($monto,$c_origen)
    {
      $conBD = new conexion();
      $sql = "INSERT INTO TRANSACCION (MONTO, TIPO, FECHA, C_ORIGEN, CUOTAS) VALUES (".$monto.", 'PAGOCREDITO', CURDATE(), ".$c_origen.", 1 )";
      $conBD->ejecutarconsulta($sql);
    }
    //Crea una notificacion de transaccion realizada para el pago de credito
    public static function crearNotificacionTransaccion($texto, $u_destino)
    {
      $conBD = new conexion();
      $sql ="INSERT INTO MENSAJES ( U_ORIGEN, U_DESTINO, MENSAJE, FECHA, ESTADO ) VALUES ( -1 ,".$u_destino.", '$texto', CURDATE(), 1)";
      $conBD->ejecutarconsulta($sql);
    }
    //obtiene todas las cuentas de ahorros del banco
    public static function obtenerC_Ahorros()
    {
      $conBD = new conexion();
      $sql = "SELECT * FROM C_AHORRO";
      return $conBD->ejecutarconsulta($sql);
    }
    //Incrementa el saldo de las cuentas en base al interes del banco (global)
    public static function incrementarSaldo($monto, $idc_ahorro)
    {
      $conBD = new conexion();
      $sql = "UPDATE C_AHORRO SET C_AHORRO.JAVECOINS = ".$monto." WHERE C_AHORRO.IDC_AHORRO=".$idc_ahorro;
      $conBD->ejecutarconsulta($sql);
    }

    public static function obtenerMes($date)
    {
      $conBD = new conexion();
      //$sql = "MONTH("$date")";
    }
  }
?>
