<?php
// este archivo se encarga de consignar en una cuenta de este banco 
include_once "../../modelo/m_c_ahorro.php";
include_once "../../modelo/m_transaccion.php";
include_once "../../modelo/m_mensaje.php";
$destino =  $_POST['cuentad'];
$origen = $_POST['cuentao'];
$banco = $_POST['banco'];
$monto = $_POST['monto'];
$pass = $_POST['pass'];
$tipo = $_POST['tipo'];

$hashed_password = crypt('mypassword');
// encriptar pass
if(hash_equals($hashed_password, crypt($pass, $hashed_password)))
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

    if($tipo != 'ENTRA' or $tipo != 'SALE')
    {
        $bandera = false;
        echo json_encode(array('message' => 'El tipo de la transaccion no es valido'));
    }
    if($bandera)
    {
        if($tipo == 'ENTRA')
        {
            entra($origen, $destino, $banco, $monto);
        }
        else {
            sale($origen, $destino, $banco, $monto);
        }
    }
}
else
{
    echo json_encode(array('message' => 'la contraseña es incorrecta'));
}

function entra($origen, $destino, $banco, $monto)
{
 $consulta = c_ahorro::getC_ahorro($destino);
 if(!mysqli_num_rows($consulta) < 1)
 {
    $datos;
    while($fila = mysqli_fetch_array($consulta)) {
        $datos = $fila;
     }
    c_ahorro::consignarMonto($monto, $destino);
    // hacer la transaccion
    transaccion::consignarC_ahorro($origen,$destino,$monto);
    // hacer la notificacion
    $mensaje = "se ha hecho una consignación a la cuenta ".$destino." por parte de la cuenta ".$origen."del banco ".$banco." el dia ".date("Y-m-d H:i:s");
    m_mensaje::mensaje($origen,$datos[3],$mensaje);
 }
 else
 {
    echo json_encode(array('message' => 'La cuenta destino no existe'));
 }
}

function sale($origen, $destino, $banco, $monto)
{
    $consulta = c_ahorro::getC_ahorro($origen);
 if(!mysqli_num_rows($consulta) < 1)
 {
     $datos;
    while($fila = mysqli_fetch_array($consulta)) {
        $datos = $fila;
     }
     if($datos[1] - $monto > 0)
     {
        c_ahorro::disminuirJaveCoinsXIDAhorro($monto,$origen);
        // hacer la transaccion
        // hacer la notificacion
     }
     else
     {
        echo json_encode(array('message' => 'la cuenta origen no tiene fondos suficientes'));
     }

 }
 else
 {
    echo json_encode(array('message' => 'La cuenta origen no existe no existe'));
 }
}

// http://localhost/API/cuenta/prueba.php?cuentad=4&cuentao=2&banco0=aaaa&monto=22000
?>