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

$hash11= '$2y$10$lUr8L1VQ2J0R4OZ64.Qvhe2/n790ka.KL3MfDkeO5D3vf1Nurp4zS';
// encriptar pass
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
            entra($origen, $destino, $banco, $monto);
    }
}
else
{
    echo json_encode(array('message' => 'la contrasena es incorrecta'));
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
    transaccion::consignarC_ahorro($origen,$destino,$monto,$banco);
    // hacer la notificacion
    $mensaje = "se ha hecho una consignación a la cuenta ".$destino." por parte de la cuenta ".$origen."del banco ".$banco." el dia ".date("Y-m-d H:i:s");
    m_mensaje::mensaje($origen,$datos[3],$mensaje);
    // return 
    echo json_encode(array('message' => "la consignacion a la cuenta $destino por monto $monto fue exitosa"));
 }
 else
 {
    echo json_encode(array('message' => 'La cuenta destino no existe'));
 }
}

// http://localhost/API/cuenta/prueba.php?cuentad=4&cuentao=2&banco0=aaaa&monto=22000
?>