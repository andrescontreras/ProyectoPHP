<?php
include_once 'm_conexion.php';

class m_credito
{
    //Mosrar Creditos pendientes
  public static function mostrarCreditos($id)
  {
    $conBD = new conexion();
    $sql = "SELECT * FROM CREDITO WHERE CREDITO.USUARIO = " . $id . " and CREDITO.ESTADO = 'APROBADO'";
    return $conBD->ejecutarconsulta($sql);
  }
    //Mostrar deuda del crédito
  public static function mostrarMonto($id)
  {
    $conBD = new conexion();
    $sql = "SELECT MONTO FROM CREDITO WHERE CREDITO.USUARIO =" . $id;
    return $conBD->ejecutarconsulta($sql);
  }
    //Pagar el crédito
  public static function actualizarCredito($id, $monto)
  {
    $conBD = new conexion();
    if ($monto == 0) {
      $sql = "DELETE FROM CREDITO WHERE CREDITO.IDCREDITO =" . $id;
    } else {
      $sql = "UPDATE CREDITO SET MONTO = " . $monto . " WHERE CREDITO.IDCREDITO =" . $id;
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
  public static function enviarNotificacionCredito($texto)
  {
    $conBD = new conexion();
    $consulta = m_credito::administradores();
    while ($fila = mysqli_fetch_array($consulta)) {
      $usuario = $fila['IDUSUARIO'];
      $sql = "INSERT INTO MENSAJES (U_DESTINO, MENSAJE, FECHA) VALUES (" . $usuario . ", '$texto', CURDATE() )";
      $conBD->ejecutarconsulta($sql);
    }
  }
    //Crear credito
  public static function crearCredito($monto, $cedula, $correo, $interes)
  {
    $con = new conexion();
    $sql = "INSERT INTO CREDITO (ESTADO, INTERES, MONTO, USUARIO, CORREO) VALUES('EN ESPERA'," . $interes . "," . $monto . "," . $cedula . ", '$correo')";
    $texto = "Un visitante ha solicitado un nuevo credito con valor de $" . $monto . ".";
    m_credito::enviarNotificacionCredito($texto);
    return $con->ejecutarconsulta($sql);
  }
    //Añadir transaccion
  public static function agregarTransaccion($c_destino, $monto, $c_origen)
  {
    $con = new conexion();
    $sql = "INSERT INTO TRANSACCION (MONTO, TIPO, FECHA, C_ORIGEN, C_DESTINO, CUOTAS) VALUES (" . $monto . ",'PAGOCREDITO', CURDATE(), " . $c_origen . "," . $c_destino . ", 1 )";
    $con->ejecutarconsulta($sql);
  }

  public static function getVisitantes()
  {
    $conBD = new conexion();
    $sql = "SELECT * FROM credito WHERE USUARIO NOT IN (SELECT idusuario from USUARIO)";
    return $conBD->ejecutarconsulta($sql);
  }
  public static function obtenerCreditosxUsuario()
  {
    $conBD = new conexion();
    $id_usu = $_SESSION['usuario'];
    $sql = "SELECT * FROM credito WHERE USUARIO = $id_usu";
    return $conBD->ejecutarconsulta($sql);
  }
  public static function allCredito()
  {
    $conBD = new conexion();
    $sql = "SELECT * FROM credito";
    return $conBD->ejecutarconsulta($sql);
  }
  public static function disminuir_monto($monto, $id_Credito)
  {
    $conBD = new conexion();
    $sql = "UPDATE credito SET MONTO = MONTO - $monto WHERE IDCREDITO =$id_Credito";

  }
  public static function getCreditosCliente($id_usuario)
  {
    $conBD = new conexion();
    $sql = "SELECT * FROM credito WHERE usuario = $id_usuario ";

    return $conBD->ejecutarconsulta($sql);
  }

  public static function getDatosCredito($id_credito)
  {
    $conBD = new conexion();
    $sql = "SELECT * FROM credito WHERE IDCREDITO = $id_credito ";
    return $conBD->ejecutarconsulta($sql);
  }

  public static function setDatosCredito($interes, $estado, $id_credito)
  {
    $conBD = new conexion();
    echo $interes;
    echo $estado;
    echo $id_credito;
    $sql = "UPDATE credito SET INTERES = $interes, ESTADO = '$estado' WHERE IDCREDITO = $id_credito";
    return $conBD->ejecutarconsulta($sql);
  }
  public static function crearCreditoCliente($interes, $monto)
  {
    $conBD = new conexion();
    $usuario = $_SESSION['usuario'];
    $sql = "INSERT INTO credito (ESTADO,INTERES,MONTO,USUARIO) VALUES ('EN ESPERA',$interes,$monto,$usuario)";
    return $conBD->ejecutarconsulta($sql);
  }

}
?>
