<?php
include_once "../modelo/m_usuario.php";
include_once "../modelo/m_c_ahorro.php";
include_once "../modelo/m_tarjeta_c.php";
include_once "../modelo/m_transaccion.php";
include_once "../modelo/m_credito.php";
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
    public static function crearCuentaAhorro($monto){
        $consulta =  c_ahorro::crearCuentaAhorro($monto);
        if($consulta){
            return "Se creo la cuenta de ahorro";
        }else{
            return "Ocurrio un error creando la cuenta de ahorro";
        }
    }
    public static function nomUsuario(){
        $consulta = m_usuario::obtenerNombreUsuario();
        $str_datos = "";
        while($fila = mysqli_fetch_array($consulta)) {
            $str_datos=$fila['USUARIO']; 
         }
         return $str_datos;
    }
    public static function crearTCredito($id_cAhorro){
        $consulta =  tarjeta_c::crearTCredito($id_cAhorro);
        if($consulta){
            return "Se solicito la tarjeta de credito";
        }
        else{
            return "Ocurrio un error solicitando la tarjeta de credito";
        }
    }
    public static function retirar($monto_retirar){
        $consulta = c_ahorro::retirarMonto();
        $str_datos = "";
        $monto_cuenta=0;
        while($fila = mysqli_fetch_array($consulta)) {
            if($_SESSION['id_ahorro']==$fila['IDC_AHORRO']){
            $monto_cuenta = $fila['JAVECOINS'];
            }
        }
        $pagar=$monto_retirar;
        if(($monto_cuenta-$pagar)<0){
            return "<br>En su cuenta, no tiene la cantidad que quiere retirar";
        }
        else{
        $consulta = c_ahorro::disminuirJaveCoins($monto_cuenta,$pagar);
        return "<br>Retiro sus JaveCoins exitosamente";
        }  
    }
    public static function consignar($tipoPago,$monto_consig,$usuario_depositar){
        $consulta = c_ahorro::buscarCAhorroxUsuario();
        $id_ahorro=$_SESSION['id_ahorro'];
        $monto_cuenta=0;
        while($fila = mysqli_fetch_array($consulta)) {
            if($id_ahorro==$fila['IDC_AHORRO']){
            $monto_cuenta = $fila['JAVECOINS'];
            }
        }
        if($_GET["tipoPago"]=="javecoins"){
            //echo "javecoins";
                $pagar= $monto_consig;
        }
        else{
            $pagar=$monto_consig/1000;
            //echo "pagar en pesos $pagar";
        }
        if(($monto_cuenta-$pagar)<0){
            return "No tiene la cantidad de monto a consignar en la cuenta";
        }
        else{
        $flag=false;
        $consulta= c_ahorro::allSelectAhorro();
        while($fila = mysqli_fetch_array($consulta)) {
            if($usuario_depositar==$fila['IDC_AHORRO']){
                $flag=true;
            }    
        }
        }
        if($flag){
            $consulta=c_ahorro::consignarMonto($pagar,$usuario_depositar);
            //echo "UPDATE c_ahorro SET JaveCoins = JaveCoins + $pagar WHERE ID =$usuario_depositar";
            if ($consulta) {
            echo "Consignacion realizada";
                transaccion::crearTransaccionConsignacion($pagar,$usuario_depositar);
            }
            $consulta = c_ahorro::disminuirJaveCoins($monto_cuenta,$pagar);
            }else{
                return "La cuenta a la que va a consignar no existe";
        } 
    }
    public static function JaveCoins_CuentaAhorro(){
        $consulta = c_ahorro::allSelectAhorrobyUsuario();
        while($fila = mysqli_fetch_array($consulta)) {
            if($_SESSION['id_ahorro']==$fila['IDC_AHORRO']){
            $monto_cuenta = $fila['JAVECOINS'];
            }
        }
        return $monto_cuenta;
    }
    public static function solicitudCredito($interes,$monto){
        $consulta= credito::crearCredito($interes,$monto);
        if($consulta){
            return "Se envio la solicitud del credito, espere a que se apruebe por el administrador";
        }
            
    }
}
?>