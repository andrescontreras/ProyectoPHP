<?php
session_start(); 
include ("../controlador/c_cliente.php");
if(isset($_GET['consignar'])){
    $monto_c=$_GET['monto_consig'];
    $cuenta_c= $_GET['usu_consig'];
}
?>
<html>
<body>
<div>
<h3>Consignar</h3>
<form action="" method="get">

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
<input type="text" id=monto_cons name="monto_consig" value="<?php if($monto_c)echo $monto_c; else echo ""; ?>">
</div>
<div>
<label for="usu_cons">Cuenta a consignar</label>
<input type="text"  id=usu_cons name="usu_consig" value="<?php if($cuenta_c) echo $cuenta_c; else echo ""; ?>">
</div>
<input type="submit" value="Consignar" name=consignar>
</form>

<?php
if(isset($_GET['consignar'])){
    $usuario_depositar=$_GET['usu_consig'];
    $tipo_pago = $_GET["tipoPago"];
    $monto_consig= $_GET["monto_consig"];
    echo cliente::consignar($tipo_pago,$monto_consig,$usuario_depositar);
}
    
?>
</body>
</html>