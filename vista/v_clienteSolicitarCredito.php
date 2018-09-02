<?php
session_start();
include_once "../controlador/c_cliente.php";
?>
<html>
<body>
<form action="" method="get">
<label for="">Credito solicitado</label>
<input type="text" name="monto_credito">
<label for="">Tasa de interes propuesta</label>
<input type="text" name="tasa_interes">
<input type="submit" value="Solicitar interes" name="solicitar">
</form>
<form action="v_clientePrincipal.php">
<div>
<input type="submit" value="Volver">
</div>
</form>
<?php
if(isset($_GET['solicitar'])){
    echo cliente::solicitudCredito($_GET['tasa_interes'],$_GET['monto_credito']) ;
}
?>
</body>
</html>