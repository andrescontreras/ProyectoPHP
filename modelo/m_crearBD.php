<?php
include_once dirname(__FILE__) . '/m_config.php';
$con=mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS);
$sql="CREATE DATABASE Banco";
if (mysqli_query($con,$sql)) {
 echo "Base de datos Banco creada";
}else{
 echo mysqli_error($con);
}
$con=mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS, NOMBRE_DB);
$sql = "CREATE TABLE USUARIO(IDUSUARIO INT AUTO_INCREMENT,USUARIO VARCHAR(45),PASSWORD VARCHAR(45), TIPO VARCHAR(45) NOT NULL , PRIMARY KEY(IDUSUARIO))";
if (mysqli_query($con,$sql)) {
 echo "| Tabla usuario creada ";
}else{
 echo mysqli_error($con);
}
$sql = "CREATE TABLE C_AHORRO (IDC_AHORRO INT AUTO_INCREMENT, JAVECOINS INT NOT NULL, CUOTA_MANEJO INT NOT NULL, USUARIO INT NOT NULL, PRIMARY KEY(IDC_AHORRO))";
if (mysqli_query($con,$sql)) {
 echo "| Tabla c_ahorro creada ";
}else{
 echo mysqli_error($con);
}
$sql = "CREATE TABLE CREDITO (IDCREDITO INT AUTO_INCREMENT, CORREO VARCHAR(45), CEDULA INT NOT NULL, ESTADO VARCHAR(45), FECHA_PAGO DATE, INTERES INT, MONTO INT, USUARIO INT NOT NULL, PRIMARY KEY (IDCREDITO))";
if (mysqli_query($con,$sql)) {
 echo "| Tabla credito creada ";
}else{
 echo mysqli_error($con);
}
$sql = "CREATE TABLE BANCO (CUOTA_MANEJO INT NOT NULL, INTERES INT, CUOTA_OPERACION INT, INTERES_MORA INT, NOMBRE VARCHAR(45))";
if (mysqli_query($con,$sql)) {
 echo "| Tabla banco creada ";
}else{
 echo mysqli_error($con);
}
$sql = "CREATE TABLE TRANSACCION(IDTRANSACCION INT AUTO_INCREMENT, MONTO INT, TIPO VARCHAR(45), FECHA DATE, C_ORIGEN VARCHAR(45), C_DESTINO VARCHAR(45), CUOTAS INT, PRIMARY KEY(IDTRANSACCION))";
if (mysqli_query($con,$sql)) {
 echo "| Tabla transaccion creada ";
}else{
 echo mysqli_error($con);
}
$sql = "CREATE TABLE MENSAJES (U_ORIGEN INT, U_DESTINO INT NOT NULL, MENSAJE VARCHAR(100) NOT NULL, FECHA DATE NOT NULL, ID INT AUTO_INCREMENT, PRIMARY KEY (ID))";
if (mysqli_query($con,$sql)) {
 echo "| Tabla mensajes creada ";
}else{
 echo mysqli_error($con);
}
$sql = "CREATE TABLE TARJETA_C (IDTARJETA_C INT, CUOTA_MANEJO INT, USUARIO INT NOT NULL, C_AHORRO INT NOT NULL, CUPO INT NOT NULL, SOBRECUPO INT, TASA_INTERES INT, ESTADO VARCHAR(50), SALDO INT, PRIMARY KEY(IDTARJETA_C))";
if (mysqli_query($con,$sql)) {
 echo "| Tabla tarjeta_c creada ";
}else{
 echo mysqli_error($con);
}
$sql = "CREATE TABLE COMPRA (IDCOMPRA INT AUTO_INCREMENT, CUOTAS INT NOT NULL, MONTO INT NOT NULL, DESCRIPCION VARCHAR(100))";
if (mysqli_query($con,$sql)) {
 echo "| Tabla compra creada. ";
}else{
 echo mysqli_error($con);
}
 ?>
