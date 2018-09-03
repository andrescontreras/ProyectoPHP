<?php
// este archivo se encarga de recibir los pagos de cuentas alojados en este banco
include_once "../modelo/m_credito";
$destino =  $_POST['creditod'];
$origen = $_POST['cuentao'];
$banco = $_POST['banco'];
$monto = $_POST['monto'];
$pass = $_POST['pass'];

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
        entra();
    }
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