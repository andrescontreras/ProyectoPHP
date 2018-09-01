<?php
include("C:/xampp/htdocs/ProyectoPHP/modelo/m_usuario.php");
class cliente{
    public static function datosUsuario_ID($nom_usuario)
    {
             $consulta =  m_usuario::getID($nom_usuario);
             $str_datos = "";
             $id_usu="";
             while($fila = mysqli_fetch_array($consulta)) {
                $id_usu = $fila['IDUSUARIO'];
             }
             //echo "esto es id usu $id_usu <br>";
             return $id_usu;
    }
    public static function datosCuentaAhorro()
    {
             $consulta =  m_usuario::getDatosUsuarioxCuentaAhorro();
             $str_datos = "";
             while($fila = mysqli_fetch_array($consulta)) {
                $str_datos.="<option value=\"cuentaahorro_".$fila['IDC_AHORRO']."\">Cuenta de ahorro ".$fila['IDC_AHORRO']."</option>"; 
             }
             return $str_datos;
    }
    public static function datosTarjetaCredito()
    {
             $consulta =  m_usuario::getDatosUsuarioxTarjetaCredito();
             $str_datos = "";
             while($fila = mysqli_fetch_array($consulta)) {
                $str_datos.="<option value=\"tarjetacredito_".$fila['IDTARJETA_C']."\">Tarjeta de credito ".$fila['IDTARJETA_C']."</option>"; 
             }
             return $str_datos;
    }
}
?>