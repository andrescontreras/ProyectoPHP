<?php
// este archivo se encarga de consignar en una cuenta de este banco 
include_once "../modelo/m_c_ahorro";
$destino =  $_POST['cuentad'];
$origen = $_POST['cuentao'];
$banco = $_POST['banco'];
$monto = $_POST['monto'];
$pass = $_POST['pass'];
$tipo = $_POST['tipo'];

if($_POST['pass'])
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

function entra($origen, $destino, $banco, $monto)
{
 $consulta = c_ahorro::getC_ahorro($destino);
 if(!mysqli_num_rows($consulta) < 1)
 {
    c_ahorro::consignarMonto($monto, $destino);
    // hacer la transaccion
    // hacer la notificacion
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