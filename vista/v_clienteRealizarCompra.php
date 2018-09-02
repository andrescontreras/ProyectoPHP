<?php
session_start();
include_once "../controlador/c_cliente.php";
?>
<html>
<body>
<form action="" method="get">
<div>
<label for="">Cuotas</label>
<input type="text" name="cuotas">
</div>
<div>
<label for="">Monto</label>
<input type="text" name="monto">
</div>
<div>
<label for="">Descripcion</label>
<input type="text" name="descripcion">
</div>
<div>
<input type="submit" value="Comprar" name="comprar">
</div>
</form>
<br>
<form action="v_clienteMenuTCredito.php">
<div>
<input type="submit" value="Volver" name="volver">
</div>
</form>
<?php
if(isset($_GET['comprar'])){
    $cuotas =$_GET['cuotas'];
    $monto = $_GET['monto'];
    $descripcion = $_GET['descripcion'];
    echo cliente::realizarCompra($cuotas,$monto,$descripcion);
}
?>
</body>
</html>