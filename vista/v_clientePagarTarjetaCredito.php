<?php
session_start();
include_once "../controlador/c_cliente.php";
?>
<html>
<body>
<div>
<form action="" method="get">
<label for="cuentasR">Tarjetas de credito</label>
<select name="tarjetasCredito" id="cuentasR">
<?php
echo cliente::tarjetaCreditoxAhorro();
?>
</select>
</div>
<div>
<label for="">Monto que quiere pagar</label>
<input type="text" name ="monto">
<label for="pagosJC">Tipo de pago</label>
<select name="tipoPago" id="pagosJC">
<option value="javecoins">JaveCoins</option>
<option value="pesos">Pesos</option>
</select>
<input type="submit" value ="Pagar monto" name ="pagar_monto">
</div>
</form>
<br>
<form action="v_clienteMenuCAhorro.php">
<div>
<input type="submit" value="Volver" name=volver>
</div>
</form>
<?php
if(isset($_GET['pagar_monto'])){
    $porciones = explode("_", $_GET['tarjetasCredito']);
    $id_Tcredito=$porciones[1]; // porción1
    $tipo_pago = $_GET["tipoPago"];
    $monto=$_GET['monto'];
    echo cliente::pagarTCredito($monto,$id_Tcredito,$tipo_pago);
}
?>
</body>
</html>