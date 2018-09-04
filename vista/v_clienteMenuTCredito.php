<?php
session_start();
include_once "../controlador/c_cliente.php";
if ($_SESSION['nombre_cliente']) {
    if (isset($_GET['selecTCredito'])) {
        $porciones = explode("_", $_GET['tarjetasCredito']);
        $id_credito = $porciones[1]; // porción1
        $_SESSION['id_credito'] = $id_credito;
    }
} else {
    header("Location: v_ERROR.php");
}
?>
<html>
<body>
<h2>Menu tarjeta de credito</h2>
<div>
<label for="">Tarjeta de credito con id</label>
<input type="text" value="<?php echo $_SESSION['id_credito'] ?>">
</div>
<form action="v_clienteRealizarCompra.php" method="get">
<div>
<input type="submit" value="Comprar" name="compra">
</div>
</form>
<form action="v_clientePagarTCreditoxAhorro.php" method="get">
<div>
<input type="submit" value="Pagar tarjeta de credito" name="pagar_tcredito">
</div>
</form>

<br>
<form action="v_clientePrincipal.php">
<div>
<input type="submit" value="Volver" name="volver">
</div>
</form>
</body>
</html>