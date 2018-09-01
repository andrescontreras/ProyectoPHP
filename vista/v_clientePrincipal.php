<?php 
include ("controlador/c_cliente.php");
//$idUsu = cliente::datosUsuario_ID($_POST['usuario']);
$idUsu = cliente::datosUsuario_ID(1);
setcookie("usuario",$idUsu,time()+3600);
?>
<html>
<body>
<form action="crear_cuentaAhorro.php" method="post">
<div>
<label for="txtNomUsuario">Nombre del usuario </label>
<input type ="text" name="nomUsuario" id="txtNomUsuario" value="<?php echo $_POST['usuario'] ?>">
</div>
<div>
<input type="submit" name="crear_cuenta_ahorro" value="Crear cuenta de ahorro">
</div>
</form>

<form action="crear_tarjeta_credito.php" method="post">
<div>
<div>
<input type="submit" name="crear_tarjetacredito" value="Crear tarjeta de credito">
</div>
</form>
<div>
<h3>Retirar</h3>
<form action="retirar_monto.php" method="get">
<label for="cuentasR">Cuentas de ahorro</label>
<select name="cuentasRetirar" id="cuentasR">
<?php
echo cliente::datosCuentaAhorro();
?>
</select>
<label for="m_retirar">Monto a retirar</label>
<input type="text" name="monto_retirar">
<input type="submit" value="Retirar" name="retirarMonto">
</form>
</div>
<div>
<h3>Consignar</h3>
<form action="c_ahorro_consignar.php" method="get">
<label for="cuentasCl">Cuentas del cliente</label>
<select name="cuentas" id="cuentasCl">
<?php
// -------------------------------------> PARTE DE CONSIGNAR
echo cliente::datosCuentaAhorro();
?>
</select>
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