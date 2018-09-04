<?php
session_start();
include_once "../controlador/c_cliente.php";
if ($_SESSION['nombre_cliente']) {
    if (isset($_GET['consignar'])) {
        $monto_c = $_GET['monto_consig'];
        $cuenta_c = $_GET['usu_consig'];
    }
} else {
    header("Location: v_ERROR.php");
}

$monto_cuenta = cliente::JaveCoins_CuentaAhorro();
?>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
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
<input type="text" name="monto_cuenta" id=monto_c value="<?php echo $monto_cuenta ?>">
</div>
<div>
<label for="monto_cons">Monto a consignar</label>
<input type="text" id=monto_cons name="monto_consig" value="<?php if (isset($monto_c)) echo $monto_c; ?>">
</div>
<div>
<label for="usu_cons">Cuenta a consignar</label>
<input type="text"  id=usu_cons name="usu_consig" value="<?php if (isset($cuenta_c)) echo $cuenta_c; ?>">
</div>
<input class="btn btn-primary mb-2" type="submit" value="Consignar" name=consignar>
</form>
<br>
<form action="v_clienteMenuCAhorro.php">
<div>
<input class="btn btn-primary mb-2" type="submit" value="Volver" name="volver">
</div>
</form>



<?php
if (isset($_GET['consignar'])) {
    if (empty($_GET['usu_consig']) && empty($_GET['monto_consig'])) {
        echo "Debe colocar la cuenta a la que le va a consignar y debe ser un numero <br>";
        echo "Debe colocar el monto que quiere consignar y debe ser un numero <br>";
    } else if (empty($_GET['monto_consig']) || !is_numeric($_GET['monto_consig'])) {
        echo "Debe colocar el monto que quiere consignar y debe ser un numero<br>";
    } else if (empty($_GET['usu_consig']) || !is_numeric($_GET['usu_consig'])) {
        echo "Debe colocar la cuenta a la que le va a consignar y debe ser un numero<br>";
    } else {
        $usuario_depositar = $_GET['usu_consig'];
        $tipo_pago = $_GET["tipoPago"];
        $monto_consig = $_GET["monto_consig"];
        echo cliente::consignar($tipo_pago, $monto_consig, $usuario_depositar);
    }
}


?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>