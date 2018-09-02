<?php
session_start(); 
include_once "../controlador/c_cliente.php";
if(isset($_GET['consignar'])){
    $monto_c=$_GET['monto_consig'];
    $cuenta_c= $_GET['usu_consig'];
}
$monto_cuenta=cliente::JaveCoins_CuentaAhorro();
?>
<html>
<body>
<div>
<h3>Consignar</h3>
<form action="" method="get">

<div>
<label for="pagosJC">Tipo de pago</label>
<select name="tipoPago" id="pagosJC">
<option value="javecoins">JaveCoins</option>
<option value="pesos">Pesos</option>
</select>
</div>
<div>
<label for="monto_c">Monto de la cuenta</label>
<input type="text" name="monto_cuenta" id=monto_c value="<?php echo $monto_cuenta?>">
</div>
<div>
<label for="monto_cons">Monto a consignar</label>
<input type="text" id=monto_cons name="monto_consig" value="<?php if(isset($monto_c))echo $monto_c; ?>">
</div>
<div>
<label for="usu_cons">Cuenta a consignar</label>
<input type="text"  id=usu_cons name="usu_consig" value="<?php if(isset($cuenta_c)) echo $cuenta_c; ?>">
</div>
<input type="submit" value="Consignar" name=consignar>
</form>
<br>
<form action="v_clienteMenuCAhorro.php">
<div>
<input type="submit" value="Volver" name="volver">
</div>
</form>



<?php
if(isset($_GET['consignar'])){
    if(empty($_GET['usu_consig']) && empty($_GET['monto_consig'])){
        echo "Debe colocar la cuenta a la que le va a consignar <br>";
        echo "Debe colocar el monto que quiere consignar <br>";
    }else if(empty($_GET['monto_consig'])){
        echo "Debe colocar el monto que quiere consignar <br>";
    }
    else if(empty($_GET['usu_consig'])){
        echo "Debe colocar la cuenta a la que le va a consignar <br>";
    }else{
        $usuario_depositar=$_GET['usu_consig'];
        $tipo_pago = $_GET["tipoPago"];
        $monto_consig= $_GET["monto_consig"];
        echo cliente::consignar($tipo_pago,$monto_consig,$usuario_depositar);
    }
}

    
?>
</body>
</html>