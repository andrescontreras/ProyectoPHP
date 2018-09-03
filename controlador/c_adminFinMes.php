<?php
  include_once("../modelo/m_finMes.php");
  include_once("../modelo/m_usuario.php");
  include_once("../modelo/m_credito.php");
  include_once("../modelo/m_c_ahorro.php");
  include_once("../modelo/m_correo.php");
  include_once("../modelo/m_transaccion.php");
  class c_adminFinMes
  {
    //Inicia la operación de fin de mes
    public static function finDeMes()
    {
      c_adminFinMes::cobrarCreditos();
      c_adminFinMes::cobrarTarjetas();
<<<<<<< HEAD
      c_adminFinMes::cobrarCuotaManejo();
=======
      c_adminFinMes::incrementarSaldoCuentas();
>>>>>>> 21c0ee60053078e8a6d134447041c2443a47f03d
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
            while ( $filaAhorro = mysqli_fetch_array($ahorro) && $deudaCredito > 0)
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
            } 
          }
        }
          if ($deudaCredito > 0 )
          {
            $deudaCredito = ($deudaCredito * $filaCredito['INTERES']) + $deudaCredito;
            m_credito::actualizarCredito( $filaCredito['IDCREDITO'] , $deudaCredito );
            $texto = "Se ha actualizado el valor de su credito ".$filaCredito['IDCREDITO'];
            m_finMes::crearNotificacionTransaccion($texto, $filaUsuario['IDUSUARIO']);
          }
        }
        //La consulta me devuelve a los visitantes que tienen el credito aprobado
        $consulta=m_credito::creditosVisitanteAprobados();
        while ($fila = mysqli_fetch_array($consulta)){
          $correo = $fila['CORREO'];
          $fecha_pago = $fila['FECHA_PAGO'];
          $idcredito=$fila['IDCREDITO'];
          $interes = $fila['INTERES'];
          $monto_debe =$fila['MONTO'];
          if($monto_debe==0){
            //Averiguar ultima transaccion que se hizo a este credito con filtro en tipo de 'PAGOCREDITO'
            //para saber la ultima fecha que se termino de pagar el credito
            $consulta2= transaccion::buscarTransaccionVisitante($idcredito);
            while ($fila2 = mysqli_fetch_array($consulta2)){
              $fecha_final=$fila2['FECHA'];
            }
            $fin_mes=$_GET['fecha'];
              //Comparar fechas y si la fecha final es menor que la fecha pago, no pasa nada
            //Cuando el ultimo pago que se hizo al credito supera la fecha limite de pago y es antes que el fin de mes
            if( ($fecha_final>$fecha_pago) && ($fecha_final < $fin_mes)){ 
              $datetime1 = new DateTime($fecha_final);
              $datetime2 = new DateTime($fin_mes);
              $interval = $datetime1->diff($datetime2);
              $dias = $interval->format('%a');
              $monto = $interes * $dias;
              m_credito::aumentarMonto($idcredito,$monto);
            }
          }
          else{
              $subject="Credito sin pagar";
              $mensaje ="El credito que pedio con un valor de $monto_debe vencio la fecha de pago $fecha_pago";
              correo::enviarCorreo($correo,$subject,$mensaje);
              //Sacar del fecha de pago el mes, para que pueda sacar los dias de ese mes y multiplicarlos con el interes
              //y despues aumentar el monto de ese credito
              $porciones = explode("-", $fecha_pago);
              $mes=$porciones[1]; // porción1
              $dias_mes=diasMes($mes);
              $monto= $interes * $dias_mes;
              m_credito::aumentarMonto($idcredito,$monto);
              

          }
        }
      }
      
    //Cobra las tarjetas de crédito
    public static function cobrarTarjetas()
    {

    }
<<<<<<< HEAD

    //Incrementar saldo de cuentas de ahorro
    public static function incrementarSaldoCuentas()
    {
      $consulta = m_banco::getDatosBanco();
      $fila = mysqli_fetch_array($consulta);
      $interes = $fila['INTERES'];
      $consulta = m_finMes::obtenerC_Ahorros();
      while ($fila = mysqli_fetch_array($consulta))
      {
        $saldo = ($fila['JAVECOINS']*$interes) + $fila['JAVECOINS'];
        m_finMes::incrementarSaldo($saldo, $fila['IDC_AHORRO']);
      }

    }
=======
    public static function cobrarCuotaManejo(){
      $consulta=c_ahorro::allSelectAhorro();
      while ($fila = mysqli_fetch_array($consulta))
      {
        $id_ahorro= $fila['IDC_AHORRO'];
        $usuario = $fila['USUARIO'];
        $cuota_manejo=$fila['CUOTA_MANEJO'];
        $jave_coins=$fila['JAVECOINS'];
        $total = $jave_coins - $cuota_manejo;
        $jave_coins = $total;
        if($total>0){ //Cuando tiene suficiente cantidad de JaveCoins
          c_ahorro::disminuirJaveCoinsXIDAhorro( $cuota_manejo,$id_ahorro);
          $texto = "Se le han descontado $cuota_manejo JaveCoins de la cuenta $id_ahorro para pagar la cuota de manejo ";
          m_finMes::crearNotificacionTransaccion($texto, $usuario); 
          $consulta2= tarjeta_c::tCreditoAsociada($id_ahorro);
          while($filaTCredito = mysqli_fetch_array($consulta2)){//Como todavia quedan JaveCoins, explorar y pagar las cuotas de manejo de las tarjetas de credito asociadas
            $tcredito_cuota=$filaTCredito['CUOTA_MANEJO'];
            $idtarjeta_c= $filaTCredito['ID_TARJETAC'];
            $total = $jave_coins-$tcredito_cuota;
            $jave_coins=$total;
            if($total<0){ //Cuando la cuota de manejo de la tarjeta es mayor que lo que se tiene en la cuenta de ahorro, se descuenta todo lo que se tiene de la cuenta
              c_ahorro::disminuirJaveCoinsXIDAhorro( $jave_coins,$id_ahorro);
              $texto = "Se le han descontado $jave_coins JaveCoins de la cuenta $id_ahorro para pagar la cuota de manejo de la tarjeta de credito $idtarjeta_c";
              m_finMes::crearNotificacionTransaccion($texto, $usuario);
              //Como ya no tengo mas JaveCoins en la cuenta rompo el ciclo
              break;
            }
            else{
              c_ahorro::disminuirJaveCoinsXIDAhorro( $tcredito_cuota,$id_ahorro);
              $texto = "Se le han descontado $tcredito_cuota JaveCoins de la cuenta $id_ahorro para pagar la cuota de manejo de la tarjeta de credito $idtarjeta_c";
              m_finMes::crearNotificacionTransaccion($texto, $usuario);
            }
          }
        }else{ //Cuando no le alcanza a pagar con las javecoins que tiene la cuenta, descuento todo lo que tiene 
          c_ahorro::disminuirJaveCoinsXIDAhorro( $jave_coins,$id_ahorro);
          $texto = "Se le han descontado $jave_coins JaveCoins de la cuenta $id_ahorro para pagar la cuota de manejo de la cuenta de ahorro";
          m_finMes::crearNotificacionTransaccion($texto, $usuario);
        }
      }
    }
    public static function diasMes($mes){
      cal_days_in_month(CAL_GREGORIAN, $mes, 2018);
    } 
>>>>>>> 4546fde0da335e35ba319c959567c34724ceb479
  }
?>
