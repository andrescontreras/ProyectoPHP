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
      $consulta = m_usuario::getUsuarios();
      while ($fila = mysqli_fetch_array($consulta))
      {
        m_credito::mostrarCreditos($fila['IDUSUARIO']);
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
