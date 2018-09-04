<?php 
session_start();
include ("../controlador/c_cliente.php");
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
<form action="" method="post">
<label  for="cuentasCl">Cuentas de ahorro</label>
<select name="cuentas" id="cuentasCl">
<?php
echo cliente::datosCuentaAhorro();
?>
</select>
<input class="btn btn-primary mb-2" type="submit" value="Solicitar tarjeta de credito" name="solicitar_tarjetacredito">
</form>
<form action="v_clientePrincipal.php">
<input class="btn btn-primary mb-2" type="submit" name="volver" value="Volver">
</form>
<?php
if(isset($_POST['solicitar_tarjetacredito'])){
    if(!empty('cuentas')){
    $porciones = explode("_", $_POST['cuentas']);
    $id_cuenta=$porciones[1]; // porción1
    echo cliente::crearTCredito($id_cuenta);
    }else{
        echo "Debe seleccionar una cuenta de ahorro para asociar la tarjeta de credito";
    }
    
}
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>