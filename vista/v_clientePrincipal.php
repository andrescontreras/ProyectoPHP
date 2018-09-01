<?php 
session_start();
//echo "HJOLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA";
include ("C:/xampp/htdocs/ProyectoPHP/controlador/c_cliente.php");
$idUsu = cliente::datosUsuario_ID("usuario");
$_SESSION['usuario']=$idUsu;
$usuario = cliente::nomUsuario();
//Si no funciona con COOKIE utilizar session
//setcookie("usuario",$idUsu,time()+3600);
//echo $_COOKIE["usuario"]."<br>";

//echo cliente::datosCuentaAhorro();

//$idUsu = cliente::datosUsuario_ID($_POST['usuario']);
?>
<html>
<body>
<form action="v_clienteCrearCuentaAhorro.php" method="post">
<div>
<label for="txtNomUsuario">Nombre del usuario </label>
<input type ="text" name="nomUsuario" id="txtNomUsuario" value="<?php if(isset($usuario))echo $usuario?>">
</div>
<div>
<input type="submit" name="crear_cuenta_ahorro" value="Crear cuenta de ahorro">
</div>
</form>
<div>
<form action="crear_tarjeta_credito.php" method="post">
<input type="submit" name="crear_tarjetacredito" value="Crear tarjeta de credito">
</div>
<div>
<form action="" method="post">
<input type="submit" name="pedir_credito" value="Solicitar credito">
</form>
</div>
</form>
<div>
<form action="retirar_monto.php" method="get">
<label for="cuentasR">Cuentas de ahorro</label>
<select name="cuentasRetirar" id="cuentasR">
<?php
echo cliente::datosCuentaAhorro();
?>
</select>
<input type="submit" value ="Seleccionar" name ="selecAhorro">
<label for="m_retirar">Monto a retirar</label>
<input type="text" name="monto_retirar">
<input type="submit" value="Retirar" name="retirarMonto">
</form>
</div>
<div>
<h3>Consignar</h3>
<form action="c_ahorro_consignar.php" method="get">
<label for="cuentasCl">Tarjetas de credito</label>
<select name="cuentas" id="cuentasCl">
<?php
// -------------------------------------> PARTE DE CONSIGNAR
echo cliente::datosTarjetaCredito();
?>
</select>
<input type="submit" value ="Seleccionar" name ="selecTCredito">
</div>
<div>
<label for="agosJC">Tipo de pago</label>
<select name="tipoPago" id="pagosJC">
<option value="javecoins">JaveCoins</option>
<option value="pesos">Pesos</option>
</select>
</div>
<div>
<label for="monto_c">Monto de la cuenta</label>
<input type="text" name="monto_cuenta" id=monto_c>
</div>
<div>
<label for="monto_cons">Monto a consignar</label>
<input type="text" id=monto_cons name="monto_consig">
</div>
<div>
<label for="usu_cons">Cuenta a consignar</label>
<input type="text"  id=usu_cons name="usu_consig">
</div>
<input type="submit" value="Consignar" name=consignar>

</form>
</body>
</html>