<?php
session_start();
include_once "../controlador/c_cliente.php";
?>
<html>
<body>
<div>
<form action="" method="get">
<label for="cuentasR">Cuentas de ahorro</label>
<select name="cuentasAhorro" id="cuentasR">
<?php
echo cliente::datosCuentaAhorro();
?>
</select>
</div>
<div>
<div>
<label for="">Monto que quiere pagar</label>
<input type="text" name ="monto">
<label for="pagosJC">Tipo de pago</label>
<select name="tipoPago" id="pagosJC">
<option value="javecoins">JaveCoins</option>
<option value="pesos">Pesos</option>
</select>
<input type="submit" value ="Pagar con la cuenta de ahorro seleccionada" name ="pagar_monto">
</div>
</div>
</form>
<?php
if(isset($_GET['pagar_monto'])){
    $porciones = explode("_", $_GET['cuentasAhorro']);
    $id_CAhorro=$porciones[1]; // porción1
    $tipo_pago = $_GET["tipoPago"];
    $monto=$_GET['monto'];
    echo cliente::pagarTCreditoxCAhorro($monto,$id_CAhorro,$tipo_pago);
}
?>
</body>
</html>