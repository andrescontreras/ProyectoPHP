<?php
// este archivo se encarga de recibir los pagos de cuentas alojados en este banco

include_once "../../modelo/m_credito.php";
include_once "../../modelo/m_transaccion.php";
include_once "../../modelo/m_mensaje.php";

$destino =  $_POST['creditod'];
$origen = $_POST['cuentao'];
$banco = $_POST['banco'];
$monto = $_POST['monto'];
$pass = $_POST['pass'];

$hash11= '$2y$10$lUr8L1VQ2J0R4OZ64.Qvhe2/n790ka.KL3MfDkeO5D3vf1Nurp4zS';

if(password_verify($pass, $hash11))
{
    
    $bandera = true;
    if(!is_numeric($destino))
    {
        $bandera = false;
        echo json_encode(array('message' => 'El destino debe ser numerico'));
    }
    if(!is_numeric($origen))
    {
        $bandera = false;
        echo json_encode(array('message' => 'El origen debe ser numerico'));
    }
    if(!is_numeric($monto))
    {
        $bandera = false;
        echo json_encode(array('message' => 'El monto debe ser numerico'));
    }
    if(empty($banco))
    {
        $bandera = false;
        echo json_encode(array('message' => 'El banco no debe estar vacio'));
    }

    if($bandera)
    {
        pagarCredito($origen, $destino, $banco, $monto);
    }
}
else
{
    echo json_encode(array('message' => 'La contrasena de conexion es incorrecta'));
}

// se paga un credito desde un banco externo
function pagarCredito($origen, $destino, $banco, $monto)
{
 $consulta = m_credito::getDatosCredito($destino);
 if(!mysqli_num_rows($consulta) < 1)
 {
    $datos;
    while($fila = mysqli_fetch_array($consulta)) {
        $datos = $fila;
     }
     if($datos[5] - $monto >= 0)
     {
         // operacion
         m_credito::disminuir_monto($monto, $destino);
        // transaccion
        transaccion::t_pagoCredito($monto,$destino,$origen,$banco);
        // mensaje
        $mensaje = "Se ha pagado el credito con id: $destino con un monto de $monto a través de la cuenta $origen del banco $banco  el dia ".date("Y-m-d H:i:s");
        m_mensaje::mensaje($origen,$datos[6],$mensaje);
        echo json_encode(array('message' => "El pago del credito con id: $destino, a traves de la cuenta de ahorros $origen del banco $banco se realizo correctamente"));
     }
    
 }
 else
 {
    echo json_encode(array('message' => 'La credito destino no existe'));
 }
}

// http://localhost/API/cuenta/prueba.php?cuentad=4&cuentao=2&banco0=aaaa&monto=22000
?>