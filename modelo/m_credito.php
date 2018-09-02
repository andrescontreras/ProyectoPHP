<?php
  include_once 'm_conexion.php';

  class m_credito{
    //Mosrar Creditos pendientes
    public static function mostrarCreditos($id)
    {
      $conBD = new conexion();
      $sql = "SELECT * FROM CREDITO WHERE CREDITO.USUARIO = ".$id." and CREDITO.ESTADO = 'APROBADO'";
      return $conBD->ejecutarconsulta($sql);
    }
    //Mostrar deuda del crédito
    public static function mostrarMonto($id)
    {
      $conBD = new conexion();
      $sql = "SELECT MONTO FROM CREDITO WHERE CREDITO.USUARIO =" .$id;
      return $conBD->ejecutarconsulta($sql);
    }
    //Pagar el crédito
    public static function actualizarCredito($id, $monto)
    {
      $conBD = new conexion();
      if ($monto == 0)
      {
        $sql = "DELETE FROM CREDITO WHERE CREDITO.IDCREDITO =".$id;
      }
      else {
        $sql = "UPDATE CREDITO SET MONTO = ".$monto." WHERE CREDITO.IDCREDITO =". $id;
      }
      return $conBD->ejecutarconsulta($sql);
    }
    //Obtener administradores
    public static function administradores()
    {
      $conBD = new conexion();
      $sql = "SELECT IDUSUARIO FROM USUARIO WHERE USUARIO.TIPO = 'ADMIN'";
      return $conBD->ejecutarconsulta($sql);
    }
    //Crear notificacion solicitud crédito
    public static function enviarNotificacionCredito ($texto)
    {
      $conBD = new conexion();
      $consulta = m_credito::administradores();
      while ($fila = mysqli_fetch_array($consulta))
      {
        $usuario = $fila['IDUSUARIO'];
        $sql = "INSERT INTO MENSAJES (U_DESTINO, MENSAJE, FECHA) VALUES (".$usuario.", '$texto', CURDATE() )";
        $conBD->ejecutarconsulta($sql);
      }
    }
    //Crear credito
    public static function crearCredito ($monto, $cedula, $correo, $interes )
    {
      $con = new conexion();
      $sql = "INSERT INTO CREDITO (ESTADO, INTERES, MONTO, USUARIO, CORREO) VALUES('EN ESPERA',".$interes.",".$monto.",".$cedula.", '$correo')";
      $texto = "Un visitante ha solicitado un nuevo credito con valor de $".$monto.".";
      m_credito::enviarNotificacionCredito($texto);
      return $con->ejecutarconsulta($sql);
    }
    //Añadir transaccion
    public static function agregarTransaccion($c_destino, $monto, $c_origen)
    {
      $con = new conexion();
      $sql = "INSERT INTO TRANSACCION (MONTO, TIPO, FECHA, C_ORIGEN, C_DESTINO, CUOTAS) VALUES (".$monto.",'PAGOCREDITO', CURDATE(), ".$c_origen.",".$c_destino.", 1 )";
      $con->ejecutarconsulta($sql);
    }
  }
 ?>
