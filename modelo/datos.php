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
<?php
include_once dirname(__FILE__) . '/config.php';
$con=mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS, NOMBRE_DB);
$sql = "INSERT INTO USUARIO (USUARIO, PASSWORD, TIPO ) VALUES ('felipe', 'god', 'ADMIN')";//:v
if (mysqli_query($con,$sql)) {
 echo "Datos insertados :3  |";
}else{
 echo mysqli_error($con);
}
$sql = "INSERT INTO USUARIO (USUARIO, PASSWORD, TIPO ) VALUES ('DASH', 'JAJA', 'CLIENTE')";
if (mysqli_query($con,$sql)) {
 echo " Datos insertados :3 |";
}else{
 echo mysqli_error($con);
}
$sql = "INSERT INTO USUARIO (USUARIO, PASSWORD, TIPO ) VALUES ('cocu', 'nubo', 'CLIENTE')";
if (mysqli_query($con,$sql)) {
 echo " Datos insertados :3 |";
}else{
 echo mysqli_error($con);
}
$sql = "INSERT INTO USUARIO (USUARIO, PASSWORD, TIPO ) VALUES ('chanti', 'lli3', 'CLIENTE')";
if (mysqli_query($con,$sql)) {
 echo " Datos insertados :3 |";
}else{
 echo mysqli_error($con);
}
$sql = "INSERT INTO USUARIO (USUARIO, PASSWORD, TIPO ) VALUES ('zero', 'el', 'CLIENTE')";
if (mysqli_query($con,$sql)) {
 echo " Datos insertados :3 |";
}else{
 echo mysqli_error($con);
}
$sql = "INSERT INTO USUARIO (USUARIO, PASSWORD, TIPO ) VALUES ('juan', 'al', 'ADMIN')";
if (mysqli_query($con,$sql)) {
 echo " Datos insertados :3 |";
}else{
 echo mysqli_error($con);
}

$sql = "INSERT INTO C_AHORRO (JAVECOINS, CUOTA_MANEJO, USUARIO) VALUES (150, 70, 2)";
if (mysqli_query($con,$sql)) {
 echo " Ahorros insertados :3 |";
}else{
 echo mysqli_error($con);
}
$sql = "INSERT INTO C_AHORRO (JAVECOINS, CUOTA_MANEJO, USUARIO) VALUES (4000, 70, 3)";
if (mysqli_query($con,$sql)) {
 echo " Ahorros insertados :3 |";
}else{
 echo mysqli_error($con);
}
$sql = "INSERT INTO C_AHORRO (JAVECOINS, CUOTA_MANEJO, USUARIO) VALUES (375, 70, 2)";
if (mysqli_query($con,$sql)) {
 echo " Ahorros insertados :3 |";
}else{
 echo mysqli_error($con);
}
$sql = "INSERT INTO C_AHORRO (JAVECOINS, CUOTA_MANEJO, USUARIO) VALUES (1000, 50, 4)";
if (mysqli_query($con,$sql)) {
 echo " Ahorros insertados :3 |";
}else{
 echo mysqli_error($con);
}
$sql = "INSERT INTO C_AHORRO (JAVECOINS, CUOTA_MANEJO, USUARIO) VALUES (20, 70, 5)";
if (mysqli_query($con,$sql)) {
 echo " Ahorros insertados :3 |";
}else{
 echo mysqli_error($con);
}
$sql = "INSERT INTO CREDITO (ESTADO, FECHA_PAGO, INTERES, MONTO, USUARIO, CORREO) VALUES ('EN ESPERA', CURDATE(), 0.17, 300, 2, 'felipe@contreras.com' )";
if (mysqli_query($con,$sql)) {
 echo " Credito insertado :3 |";
}else{
 echo mysqli_error($con);
}
$sql = "INSERT INTO CREDITO (ESTADO, FECHA_PAGO, INTERES, MONTO, USUARIO, CORREO) VALUES ('APROBADO', '2018-08-27', 0.17, 800, 4, 'santi@dash.com' )";
if (mysqli_query($con,$sql)) {
 echo " Credito insertado :3 |";
}else{
 echo mysqli_error($con);
}
$sql = "INSERT INTO CREDITO (ESTADO, FECHA_PAGO, INTERES, MONTO, USUARIO, CORREO) VALUES ('APROBADO', '2018-08-27', 0.17, 400, 3, 'juan@ario.com' )";
if (mysqli_query($con,$sql)) {
 echo " Credito insertado :3 |";
}else{
 echo mysqli_error($con);
}
$sql = "INSERT INTO CREDITO (ESTADO, FECHA_PAGO, INTERES, MONTO, USUARIO, CORREO) VALUES ('RECHAZADO', '2018-08-12', 0.17, 3000, 5, 'zero@grozero.com' )";
if (mysqli_query($con,$sql)) {
 echo " Credito insertado :3 |";
}else{
 echo mysqli_error($con);
}
$sql = "INSERT INTO TARJETA_C (CUOTA_MANEJO, USUARIO, C_AHORRO, CUPO, SOBRECUPO, TASA_INTERES, ESTADO, SALDO) VALUES (80, 3, 1, 1000, 300, 0.3, 'APROBADO', 800 )";
if (mysqli_query($con,$sql)) {
 echo " Tarjeta insertado :3 |";
}else{
 echo mysqli_error($con);
}
 ?>

?>
