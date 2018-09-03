<?php
// este archivo se encarga de recibir los pagos de cuentas alojados en este banco
include_once "../../modelo/m_credito.php";
$destino =  $_POST['creditod'];
$origen = $_POST['cuentao'];
$banco = $_POST['banco'];
$monto = $_POST['monto'];
$pass = $_POST['pass'];

$hash11= '$2y$10$lUr8L1VQ2J0R4OZ64.Qvhe2/n790ka.KL3MfDkeO5D3vf1Nurp4zS';

if(password_verify($pass, $hash11))
{

    echo json_encode(array('message' => 'CORRECTO'));
    /*
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
        entra();
    }*/
}
else
{
    echo json_encode(array('message' => 'La contraseña de conexion es incorrecta'));
}

function entra($origen, $destino, $banco, $monto)
{
 $consulta = c_ahorro::getDatosCredito($destino);
 if(!mysqli_num_rows($consulta) < 1)
 {
    $datos;
    while($fila = mysqli_fetch_array($consulta)) {
        $datos = $fila;
     }
     if(datos[5] - $monto >= 0)
     {
        c_ahorro::disminuir_monto($monto, $destino);
        // hacer la transaccion
        // hacer la notificacion
     }
    
 }
 else
 {
    echo json_encode(array('message' => 'La credito destino no existe'));
 }
}

// http://localhost/API/cuenta/prueba.php?cuentad=4&cuentao=2&banco0=aaaa&monto=22000
?>