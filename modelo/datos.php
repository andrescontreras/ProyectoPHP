<?php
// este archivo se encarga de llenas las tablas con datos de prueba
include_once dirname(__FILE__) . '/m_config.php';
$con=mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS, NOMBRE_DB);
$sql="INSERT INTO banco (`CUOTA_MANEJO`, `INTERES`, `CUOTA_OPERACION`, `INTERES_MORA`, `NOMBRE`) VALUES (1000,20000,50000,30000,'NombreBanco')";
if (mysqli_query($con,$sql)) {
 echo "se realizo la insercion";
}else{
 echo mysqli_error($con);
}
?>