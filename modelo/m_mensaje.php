<?php
include_once "m_conexion.php";
class m_mensaje
{
    public static function mensaje($origen, $destino, $mensaje)
    {
        $conBD = new conexion();
        $sql = "INSERT INTO MENSAJES (U_ORIGEN, U_DESTINO, MENSAJE, FECHA, ESTADO)
        VALUES ($origen,$destino,$mensaje,$fecha,1)";
        return $conBD->ejecutarconsulta($sql);
    }
}
?>