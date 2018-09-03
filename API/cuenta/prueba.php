<?php
// este archivo se encarga de consignar en una cuenta de este banco 
include_once "";
$destino =  $_POST['cuentad'];
$origen = $_POST['cuentao'];
$banco = $_POST['banco'];
$monto = $_POST['monto'];

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

    if($bandera)
    {
        
    }
}

// http://localhost/API/cuenta/prueba.php?cuentad=4&cuentao=2&banco0=aaaa&monto=22000
?>