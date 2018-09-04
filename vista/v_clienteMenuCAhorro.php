<?php
session_start();
include_once "../controlador/c_cliente.php";
if ($_SESSION['nombre_cliente']) {
    if (isset($_GET['selecAhorro'])) {
        $porciones = explode("_", $_GET['cuentasAhorro']);
        $id_ahorro = $porciones[1]; // porción1
        $_SESSION['id_ahorro'] = $id_ahorro;
    }
} else {
    header("Location: v_ERROR.php");
}
?>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<h2>Menu cuenta de ahorro</h2>
<div>
<label for="">Cuenta de ahorro con id</label>
<input type="text" value="<?php echo $_SESSION['id_ahorro'] ?>">
</div>
<form action="v_clienteRetirar.php" method="get">
<div>
<input class="btn btn-primary mb-2" type="submit" value="Retirar" name="retirar">
</div>
</form>

<form action="v_clienteConsignar.php" method="post">
<div>
<input class="btn btn-primary mb-2" type="submit" value="Consignar en cuenta de ahorro" name="consignar_ahorro">
</div>
</form>


<form action="v_clientePagarTarjetaCredito.php">
<div>
<input class="btn btn-primary mb-2" type="submit" value="Pagar tarjeta de credito" name="pagar_Tcredito">
</div>
</form>

<form action="v_clientePagarCredito.php">
<div>
<input class="btn btn-primary mb-2" type="submit" value="Pagar credito" name="pagar_credito">
</div>
</form>

<br>
<form action="v_clientePrincipal.php">
<div>
<input class="btn btn-primary mb-2" type="submit" value="Volver" name="volver">
</div>
</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>