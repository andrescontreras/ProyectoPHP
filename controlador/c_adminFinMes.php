<?php
  include_once("../modelo/m_finMes.php");
  include_once("../modelo/m_usuario.php");
  include_once("../modelo/m_credito.php");
  include_once("../modelo/m_c_ahorro.php");
  class c_adminFinMes
  {
    //Inicia la operación de fin de mes
    public static function finDeMes()
    {
      c_adminFinMes::cobrarCreditos();
      c_adminFinMes::cobrarTarjetas();
    }
    //cobra los créditos
    public static function cobrarCreditos()
    {
      $usuarios = m_usuario::getUsuarios();
      while ($filaUsuario = mysqli_fetch_array($usuarios))
      {
        $creditos = m_credito::mostrarCreditos($filaUsuario['IDUSUARIO']);
        while ($filaCredito = mysqli_fetch_array($creditos))
        {
          $ahorro = m_usuario::obtenerC_Ahorros($filaUsuario['IDUSUARIO']); //OBTIENE LAS CUENTAS DE AHORRO DE MAYOR A MENOR MONTO
          $deudaCredito = $filaCredito['MONTO'];
          $valorPagado = 0;
          if ($deudaCredito->num_rows > 0 ){ //Si es cliente
            while ( $filaAhorro = mysqli_fetch_array() && $deudaCredito > 0)
            {
              $valorAhorros = $filaAhorro['JAVECOINS'] ;
              if (  $valorAhorros - $deudaCredito <= 0 )
              {
                $valorPagado = $valorAhorros;
                $deudaCredito = $deudaCredito - $valorAhorros;
              }
              else {
                $valorPagado = $deudaCredito;
                $deudaCredito = 0;
                $valorAhorros = $filaCredito['Monto'];
              }
              m_credito::actualizarCredito( $filaCredito['IDCREDITO'] , $deudaCredito );
              c_ahorro::disminuirJaveCoinsXIDAhorro( $valorAhorros, $filaAhorro['IDC_AHORRO']);
              m_finMes::crearTransaccionPagoCredito($valorPagado, $filaAhorro['IDC_AHORRO'] );
              $texto = "Se le han descontado ".$valorAhorros. " de la cuenta ". $filaAhorro['IDC_AHORRO']." para pagar su crédito ". $filaCredito['IDCREDITO'];
              m_finMes::crearNotificacionTransaccion($texto, $filaUsuario['IDUSUARIO']);
            } else {//Si no es cliente

            }
          }
          if ($deudaCredito > 0 )
          {
            $deudaCredito = $deudaCredito * $filaCredito*['INTERES'];
            m_credito::actualizarCredito( $filaCredito['IDCREDITO'] , $deudaCredito );
            $texto = "Se ha actualizado el valor de su credito ".$filaCredito['IDCREDITO'];
            m_finMes::crearNotificacionTransaccion($texto, $filaUsuario['IDUSUARIO']);
          }
        }
      }
    }
    //Cobra las tarjetas de crédito
    public static function cobrarTarjetas()
    {

    }
    public static function cobrarCuotaManejo(){
      c_adminFinMes::cuotaManejoCAhorro();
      c_adminFinMes::cuotaManejoTCredito();
    }
    public static function cuotaManejoCAhorro(){
      $consulta=c_ahorro::allSelectAhorro();
      while ($fila = mysqli_fetch_array($consulta))
      {
        $cuota_manejo=$fila['CUOTA_MANEJO'];
        $jave_coins=$fila['JAVECOINS'];
        $total = $jave_coins - $cuota_manejo;
        if($total<0){
          
        }
      }
    }
    public static function cuotaManejoTCredito(){

    }
  }
?>
