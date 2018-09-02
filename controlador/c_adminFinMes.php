<?php
  include_once("../modelo/m_finMes.php");
  include_once("../modelo/m_usuario.php");
  include_once("../modelo/m_credito.php");
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
        
      }
    }
    //Cobra las tarjetas de crédito
    public static function cobrarTarjetas()
    {

    }
  }
?>
