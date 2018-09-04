<?php
session_start();
include_once "../controlador/c_cliente.php";
if (!$_SESSION['nombre_cliente']) {
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
<div>
<form action="" method="get">
<label class="col-sm-2 col-form-label" for="cuentasR">Cuentas de ahorro</label>
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
<input class="btn btn-primary mb-2" type="submit" value ="Pagar con la cuenta de ahorro seleccionada" name ="pagar_monto">
</div>
</div>
</form>
<form action="v_clienteMenuTCredito.php">
<input class="btn btn-primary mb-2" type="submit" name="volver" value="Volver">
</form>
<?php
if(isset($_GET['pagar_monto'])){
    if(!empty($_GET['monto']) && is_numeric($_GET['monto'])){
        $porciones = explode("_", $_GET['cuentasAhorro']);
        $id_CAhorro=$porciones[1]; // porción1
        $tipo_pago = $_GET["tipoPago"];
        $monto=$_GET['monto'];
        echo cliente::pagarTCreditoxCAhorro($monto,$id_CAhorro,$tipo_pago);
    }
    else{
        echo "Debe colocar un valor en monto y debe ser un numero";
    }
    
}
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>