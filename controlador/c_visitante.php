<?php
include_once("../modelo/m_banco.php");
include_once("../modelo/m_credito.php");
include_once("../modelo/m_c_ahorro.php");
include_once("c_correo.php");
class c_visitante
{
  //Solicitar un nuevo credito
  public static function solicitarCredito($monto,$correo,$cedula)
  {
    $consulta = m_banco::getDatosBanco();
    $fila = mysqli_fetch_array($consulta);
    $interes = $fila['INTERES'];
    $res = m_credito::crearCredito($monto, $cedula, $correo, $interes);
    $subject = "Solicitud de crédito";
    $mensaje = "Usted ha realizado una solicitud de un credito con valor de $" . $monto;
    correo::enviarCorreo($correo,$subject,$mensaje);
  }
  //Mostrar créditos pendientes
  public static function mostrarCreditos($cedula)
  {
    $consulta = m_credito::mostrarCreditos($cedula);
    return $consulta;
  }
  //Mostrar valor deuda del crédito
  public static function mostrarMontoCredito($id)
  {
    $consulta = m_credito::mostrarMonto($id);
    $valor = mysqli_fetch_array($consulta);
    return $valor['MONTO'];
  }
  //Pagar deuda crédito
  public static function transaccionCredito($id, $monto, $c_origen, $correo)
  {
    $montoCredito = c_visitante::mostrarMontoCredito($id);
    if ($monto > $montoCredito )
    {
      $monto = $montoCredito;
    }
    $nuevoMonto = $montoCredito - $monto;
    m_credito::actualizarCredito($id, $nuevoMonto);
    m_credito::agregarTransaccion($id, $monto, $c_origen);
    $subject = "Transaccion de crédito";
    $mensaje = "Usted ha realizado una transaccion con valor de $" . $nuevoMonto;
    correo::enviarCorreo($correo,$subject,$mensaje);
  }
  //Validar ID de cuenta si existe en la base de datos
  public static function validarId($id)
  {
    return $res = c_ahorro::validarId($id);
  }

  //Realizar consignacion a cuenta de ahorros
  public static function consignarC_Ahorros ($id, $cedula, $correo, $monto )
  {
    $consulta = c_ahorro::dineroAhorrado($id);
    $fila = mysqli_fetch_array($consulta);
    $nuevoMonto = $fila['JAVECOINS'] + $monto;
    c_ahorro::consignarVisitante($id, $cedula, $nuevoMonto );
    $subject = "Consignacion a cuenta de ahorros";
    $mensaje = "Usted ha realizado una consignacion con valor de $" . $nuevoMonto;
    correo::enviarCorreo($correo,$subject,$mensaje);
  }
}

?>
