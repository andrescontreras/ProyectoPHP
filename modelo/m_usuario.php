<?php
include_once "../modelo/m_conexion.php";
class m_usuario{
    public static function getID($nom_usuario)
    {
            $conBD = new conexion();
            $sql ="SELECT * FROM usuario WHERE USUARIO ='".$nom_usuario."'";
            return $conBD->ejecutarconsulta($sql);
    }
    public static function getUsuario($usuario)
    {
        $conBD = new conexion();
            $sql ="SELECT * FROM usuario WHERE USUARIO = '$usuario'";
            return $conBD->ejecutarconsulta($sql);
    }

    public static function setUsuario($usuario, $clave)
    {
        $conBD = new conexion();
            $sql ="INSERT INTO usuario ( USUARIO , PASSWORD, TIPO ) VALUES ('$usuario','$clave','CLIENTE')";
            return $conBD->ejecutarconsulta($sql);
    }
    public static function getDatosUsuarioxCuentaAhorro()
    {
            $conBD = new conexion();
            //echo "SELECT * FROM c_ahorro WHERE USUARIO=".$_SESSION["usuario"]."<br>";
            $sql ="SELECT * FROM c_ahorro WHERE USUARIO=".$_SESSION["usuario"];
            return $conBD->ejecutarconsulta($sql);
    }
    public static function getDatosUsuarioxTarjetaCredito()
    {
            $conBD = new conexion();
            $sql ="SELECT * FROM tarjeta_c WHERE USUARIO=".$_SESSION["usuario"];
            return $conBD->ejecutarconsulta($sql);
    }
    public static function obtenerNombreUsuario(){
        $conBD = new conexion();
        $sql ="SELECT * FROM usuario WHERE IDUSUARIO ='".$_SESSION["usuario"]."'";
        return $conBD->ejecutarconsulta($sql);
    }

    public static function getUsuarios()
    {
        $conBD = new conexion();
        $sql = "SELECT * FROM usuario";
        return $conBD->ejecutarconsulta($sql);
    }

    //retorna las notificaciones del USUARIO
    public static function mostrarNotificaciones($id_usuario)
    {
      m_usuario::actualizarEstado($id_usuario);
      $conBD = new conexion();
      $sql = "SELECT * FROM MENSAJES WHERE MENSAJES.U_DESTINO = ".$id_usuario. " ORDER BY MENSAJES.ID DESC";
      return $conBD->ejecutarconsulta($sql);
    }
    //Indica que las notificaciones se han leído
    public static function actualizarEstado($id_usuario)
    {
      $conBD = new conexion();
      $sql = "UPDATE MENSAJES SET MENSAJES.ESTADO = 0 WHERE MENSAJES.U_DESTINO = ". $id_usuario. " and MENSAJES.ESTADO = 1";
      return $conBD->ejecutarconsulta($sql);
    }
    //Cuantas notificaiones no se han leido
    public static function notificacionesNoLeidas($id_usuario)
    {
      $conBD = new conexion ();
      $sql = "SELECT * FROM MENSAJES WHERE MENSAJES.U_DESTINO = ". $id_usuario. " and MENSAJES.ESTADO = 1";
      return $conBD->ejecutarconsulta($sql);
    }
}
?>
