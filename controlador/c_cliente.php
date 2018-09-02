<?php
include_once "../modelo/m_usuario.php";
include_once "../modelo/m_c_ahorro.php";
include_once "../modelo/m_tarjeta_c.php";
include_once "../modelo/m_transaccion.php";
include_once "../modelo/m_credito.php";
include_once "../modelo/m_compra.php";
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
                 if($fila['ESTADO']=='APROBADO'){
                    $str_datos.="<option value=\"tarjetacredito_".$fila['IDTARJETA_C']."\">Tarjeta de credito ".$fila['IDTARJETA_C']."</option>";
                 }
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
        $id_usu = $_SESSION['usuario'];
        if($consulta){
            $texto= "El usuario con id $id_usu ha solicitado una tarjeta de credito";
            m_credito::enviarNotificacionCreditoUsuario($texto);
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
        if($tipoPago=="javecoins"){
            //echo "javecoins";
                $pagar= $monto_consig;
        }
        else{
            $pagar=$monto_consig/1000;
            //echo "pagar en pesos $pagar";
        }
        if(($monto_cuenta-$pagar)<0 && $usuario_depositar!=$_SESSION['usuario']){
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
                $id_usu=$_SESSION['usuario'];
                $texto="El usuario $id_usu ha consignado a la cuenta de ahorro $usuario_depositar el valor de $pagar $tipoPago";
                m_credito::enviarNotificacionCreditoUsuario($texto);
                transaccion::crearTransaccionConsignacion($pagar,$usuario_depositar);
            }
            if($usuario_depositar!=$_SESSION['usuario']){
                $consulta = c_ahorro::disminuirJaveCoins($monto_cuenta,$pagar);
            }

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
    public static function JaveCoins_CuentaAhorroxID($id_ahorro){
        $consulta = c_ahorro::allSelectAhorrobyUsuario();
        while($fila = mysqli_fetch_array($consulta)) {
            if($id_ahorro==$fila['IDC_AHORRO']){
            $monto_cuenta = $fila['JAVECOINS'];
            }
        }
        return $monto_cuenta;
    }
    public static function solicitudCredito($interes,$monto){
        $consulta= m_credito::crearCreditoCliente($interes,$monto);
        $id_usu = $_SESSION['usuario'];
        if($consulta){
            $texto= "El usuario con id $id_usu ha solicitado un credito";
            m_credito::enviarNotificacionCreditoUsuario($texto);
            return "Se envio la solicitud del credito, espere a que se apruebe por el administrador";
        }
    }

    //Saca las tarjetas de credito asociadas a una cuenta de ahorro
    public static function tarjetaCreditoxAhorro(){
        $consulta = tarjeta_c::tcreditoxCuentaAhorro();
        $str_datos = "";
        while($fila = mysqli_fetch_array($consulta)) {
            if($fila['ESTADO']=="APROBADO"){
                $str_datos.="<option value=\"tarjetacredito_".$fila['IDTARJETA_C']."\">Tarjeta de credito ".$fila['IDTARJETA_C']."</option>";
            }
        }
        return $str_datos;
    }
    //SALDO ES LO QUE YO HE GASTADO DE LA TARJETA DE CREDITO
    public static function pagarTCredito($monto,$id_Tcredito,$tipoPago){
        $jave_coins = cliente::JaveCoins_CuentaAhorro();
        $consulta = tarjeta_c::allTCredito();
        if($tipoPago=="javecoins"){
            //echo "javecoins";
            $pagar= $monto;
        }
        else{
            $pagar=$monto/1000;
            //echo "pagar en pesos $pagar";
        }
        if($pagar>$jave_coins){
            return "La cantidad que va a pagar excede a lo que tiene en la cuenta de ahorro <br>";
        }
        while($fila = mysqli_fetch_array($consulta)) {
            if($fila['IDTARJETA_C']==$id_Tcredito){
                $saldo =$fila['SALDO'];
                if($saldo>0){
                    $sobrante =$pagar-$saldo;
                    if($sobrante<0 || $sobrante==0){
                        tarjeta_c::disminuir_saldo($pagar,$id_Tcredito);
                        c_ahorro::disminuirJaveCoins($jave_coins,$pagar);
                        transaccion::crearTransaccionPagoTCredito($pagar,$id_Tcredito);
                        return "Se realizo el pago de la tarjeta";
                    }
                    else{//sobrante>0
                        c_ahorro::disminuirJaveCoins($jave_coins,$saldo);
                        tarjeta_c::disminuir_saldo($saldo,$id_Tcredito);
                        transaccion::crearTransaccionPagoTCredito($saldo,$id_Tcredito);
                        return "Se realizo el pago total de la tarjeta";
                    }
                }
                else{
                    return "La tarjeta de credito no tiene saldos que pagar";
                }
            }
        }
    }
    public static function CreditosxUsuario(){
        $consulta = m_credito::obtenerCreditosxUsuario();
        $str_datos = "";
        while($fila = mysqli_fetch_array($consulta)) {
            if($fila['ESTADO']=="APROBADO"){
                $str_datos.="<option value=\"credito_".$fila['IDCREDITO']."\">Credito ".$fila['IDCREDITO']."</option>";
            }
        }
        return $str_datos;
    }
    public static function saldoTCredito($id_tarjetaC){
        $consulta = tarjeta_c::obtenerSaldo($id_tarjetaC);
        while($fila = mysqli_fetch_array($consulta)) {
            $saldo = $fila['SALDO'];

        }
        return $saldo;
    }
    public static function cupoTCredito($id_tarjetaC){
        $consulta = tarjeta_c::getDatosTarjeta($id_tarjetaC);
        while($fila = mysqli_fetch_array($consulta)) {
            $cupo = $fila['CUPO'];

        }
        return $cupo;
    }
    public static function pagarCredito($monto,$id_Credito,$tipoPago){
        $jave_coins = cliente::JaveCoins_CuentaAhorro();
        $consulta = m_credito::allCredito();
        if($tipoPago=="javecoins"){
            //echo "javecoins";
            $pagar= $monto;
        }
        else{
            $pagar=$monto/1000;
            //echo "pagar en pesos $pagar";
        }
        if($pagar>$jave_coins){
            return "La cantidad que va a pagar excede a lo que tiene en la cuenta de ahorro <br>";
        }
        while($fila = mysqli_fetch_array($consulta)) {
            if($fila['IDCREDITO']==$id_Credito){
                $saldo =$fila['MONTO'];
                if($saldo>0){
                    $sobrante =$pagar-$saldo;
                    if($sobrante<0 || $sobrante==0){
                        m_credito::disminuir_monto($pagar,$id_Credito);
                        c_ahorro::disminuirJaveCoins($jave_coins,$pagar);
                        transaccion::crearTransaccionPagoCredito($pagar,$id_Credito);
                        return "Se realizo el pago del credito";
                    }
                    else{//sobrante>0
                        m_credito::disminuir_monto($saldo,$id_Credito);
                        c_ahorro::disminuirJaveCoins($jave_coins,$saldo);
                        transaccion::crearTransaccionPagoCredito($saldo,$id_Credito);
                        return "Se realizo el pago total del credito";
                    }
                }
                else{
                    return "El credito ya ha sido pagado";
                }
            }
        }
    }
    public static function pagarTCreditoxCAhorro($monto,$id_CAhorro,$tipoPago){
        $jave_coins = cliente::JaveCoins_CuentaAhorroxID($id_CAhorro);
        $consulta = c_ahorro::buscarCAhorroxUsuario();
        if($tipoPago=="javecoins"){
            //echo "javecoins";
            $pagar= $monto;
        }
        else{
            $pagar=$monto/1000;
            //echo "pagar en pesos $pagar";
        }
        if($pagar>$jave_coins){
            return "La cantidad que va a pagar excede a lo que tiene en la cuenta de ahorro <br>";
        }
        while($fila = mysqli_fetch_array($consulta)) {
            if($fila['IDC_AHORRO']==$id_CAhorro){
                $id_tarjetaC=$_SESSION['id_credito'];
                $saldo =cliente::saldoTCredito($id_tarjetaC);
                if($saldo>0){
                    $sobrante =$pagar-$saldo;
                    if($sobrante<0 || $sobrante==0){
                        c_ahorro::disminuirJaveCoinsXIDAhorro($pagar,$id_CAhorro);
                        tarjeta_c::disminuir_saldo($pagar,$id_tarjetaC);
                        transaccion::crearTransaccionPagoTCredito($pagar,$id_tarjetaC);
                        return "Se realizo el pago de la tarjeta";
                    }
                    else{//sobrante>0
                        c_ahorro::disminuirJaveCoinsXIDAhorro($saldo,$id_CAhorro);
                        tarjeta_c::disminuir_saldo($saldo,$id_tarjetaC);
                        transaccion::crearTransaccionPagoTCredito($saldo,$id_tarjetaC);
                        return "Se realizo el pago total de la tarjeta";
                    }
                }
                else{
                    return "El credito ya ha sido pagado";
                }
            }
        }
    }
    public static function realizarCompra($cuotas,$monto,$descripcion){
        if($cuotas>6){
            return "Las cuotas no deben superar los 6 meses";
        }
        else{
            $id_tarjetaC=$_SESSION['id_credito'];
            $saldo =cliente::saldoTCredito($id_tarjetaC);
            $cupo =cliente::cupoTCredito($id_tarjetaC);
            if($saldo + $monto>$cupo){
                return "Realizando la compra sobrepasa el sobrecupo, compra cancelada";
            }
            else{
                compra::crearCompra($cuotas,$monto,$descripcion);
                tarjeta_c::aumentar_saldo($monto);
                transaccion::crearTransaccionCompra($monto,$cuotas);
                return "Se realizo la compra exitosamente";
            }
            
        }
    } 

    //Obtiene las notificaciones correspondientes al id
    public static function mostrarNotificaciones($idusuario)
    {
      return $res = m_usuario::mostrarNotificaciones($idusuario);
    }
}
?>
