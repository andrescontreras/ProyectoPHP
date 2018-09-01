<?php
session_start();
include_once "C:/xampp/htdocs/ProyectoPHP/controlador/c_cliente.php";
if(isset($_GET['selecAhorro'])){
$porciones = explode("_", $_GET['cuentasAhorro']);
$id_ahorro=$porciones[1]; // porción1
$_SESSION['id_ahorro']=$id_ahorro;
}
?>
<html>
<body>
<h2>Menu cuenta de ahorro</h2>
<div>
<label for="">Cuenta de ahorro con id</label>
<input type="text" value="<?php echo $_SESSION['id_ahorro']?>">
</div>
<form action="v_clienteRetirar.php" method="get">
<div>
<input type="submit" value="Retirar" name="retirar">
</div>
</form>

<form action="v_clienteConsignar.php" method="post">
<div>
<input type="submit" value="Consignar en cuenta de ahorro" name="consignar_ahorro">
</div>
</form>


<form action="">
<div>
<input type="submit" value="Pagar tarjeta de credito" name="pagar_Tcredito">
</div>
</form>

<form action="">
<div>
<input type="submit" value="Pagar credito" name="pagar_credito">
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