<?php
session_start();
include_once "../controlador/c_cliente.php";
?>
<html>
<body>
<div>
<form action="" method="get">
<label for="cuentasR">Creditos</label>
<select name="credito" id="cuentasR">
<?php
echo cliente::CreditosxUsuario();
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
    $porciones = explode("_", $_GET['credito']);
    $id_Credito=$porciones[1]; // porción1
    //echo "idCredito $id_Credito";
    $tipo_pago = $_GET["tipoPago"];
    $monto=$_GET['monto'];
    echo cliente::pagarCredito($monto,$id_Credito,$tipo_pago);
}
?>
</body>
</html>