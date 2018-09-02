<?php
class c_ahorro {
    public static function setC_manejo($cuota_manejo)
    {

    }
    public static function crearCuentaAhorro($monto){
        $conBD = new conexion();
        $sql = "INSERT INTO c_ahorro (Usuario,JaveCoins) VALUES ("."'".$_SESSION['usuario']."'".",$monto)";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function retirarMonto(){
        $conBD = new conexion();
        //echo "SELECT * FROM c_ahorro WHERE Usuario ="."'".$_SESSION['usuario']."'";
        $sql = "SELECT * FROM c_ahorro WHERE Usuario ="."'".$_SESSION['usuario']."'";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function disminuirJaveCoins($monto_cuenta,$pagar){
        $conBD = new conexion();
        $id_ahorro=$_SESSION['id_ahorro'];
        //echo "UPDATE c_ahorro SET JAVECOINS = $monto_cuenta-$pagar WHERE IDC_AHORRO = $id_ahorro";
        $sql = "UPDATE c_ahorro SET JAVECOINS = $monto_cuenta-$pagar WHERE IDC_AHORRO = $id_ahorro";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function buscarCAhorroxUsuario(){
        $conBD = new conexion();
        $id_usu=$_SESSION['usuario'];
        $sql = "SELECT * FROM c_ahorro WHERE USUARIO = $id_usu";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function allSelectAhorro(){
        $conBD = new conexion();
        $id_usu=$_SESSION['usuario'];
        $sql = "SELECT * FROM c_ahorro";
        return $conBD->ejecutarconsulta($sql);

    }
    public static function consignarMonto($pagar,$usuario_depositar){
        $conBD = new conexion();
        $id_usu=$_SESSION['usuario'];
        $sql = "UPDATE c_ahorro SET JAVECOINS = JAVECOINS + $pagar WHERE IDC_AHORRO =$usuario_depositar";
        return $conBD->ejecutarconsulta($sql);
    }
    public static function validarId($id)
    {
      $conBD = new conexion():
      $sql = "SELECT IDC_AHORRO FROM C_AHORRO WHERE C_AHORRO.IDC_AHORRO = ". $id;
      return $conBD->ejecutarconsulta($sql);
    }
    //Obtener dinero cuenta ahorro
    public static function dineroAhorrado($id)
    {
      $conBD = new conexion();
      $sql = "SELECT MONTO FROM C_AHORRO WHERE C_AHORRO.IDC_AHORRO = ". $id;
      return $conBD->ejecutarconsulta($sql);
    }
    //Consignacion de un c_visitante
    public static function consignarVisitante($id,$cedula,$correo,$monto)
    {
      $conBD = new conexion();
      $sql = "UPDATE MONTO FROM C_AHORRO WHERE C_AHORRO.IDC_AHORRO = ". $id;
      $conBD->ejecutarconsulta($sql);
      $sql = "SELECT USUARIO FROM C_AHORRO WHERE C_AHORRO.IDC_AHORRO = ". $id;
      $consulta = $conBD->ejecutarconsulta($sql);
      $fila = mysqli_fetch_array($consulta);
      $u_destino = $fila['USUARIO'];
      $texto = "Usted ha recibido una consignacion con valor de $".$monto;
      m_c_ahorro::enviarNotificacionConsignaciónVis($u_desitno,$text);
      m_c_ahorro::registrarTransaccion($monto, $cedula, $id);

    }
    //Notificacion de consignación en la cuenta de ahorros
    public static function enviarNotificacionConsignaciónVis($u_destino,$texto)
    {
      $conBD = new conexion();
      $sql = "INSERT INTO MENSAJES (U_DESTINO, MENSAJE) VALUES (".$u_destino.", '$texto' )";
      $conBD->ejecutarconsulta($sql);
    }
    //Se registra la transaccion de Consignacion
    public static function registrarTransaccion($monto, $c_origen, $c_destino)
    {
      $conBD = new conexion();
      $sql = "INSERT INTO TRANSACCION (MONTO, TIPO, FECHA, C_ORIGEN, C_DESTINO, CUOTAS ) VALUES (".$monto.", 'CONSIGNACION', CURDATE(), ".$c_origen.",".$c_destino.", 1 )";
      $conBD->ejecutarconsulta($sql);
    }
}
?>
