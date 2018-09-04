<?php
session_start();
include_once "../controlador/c_cliente.php";
if ($_SESSION['nombre_cliente']) {
$usuario = cliente::nomUsuario();
}
else
{
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
<div>
<label class="col-sm-2 col-form-label" for="txtUsu">Usuario</label>
<input class="form-control" type="text" name="usuario" id="txtUsu" value="<?php if(isset($usuario)){echo $usuario;} else{echo $nomUsuario;}  ?>">
</div>
<div>
<label class="col-sm-2 col-form-label" for="monto_cons">Monto que quiere consignar</label>
<input class="form-control" type="text"  id=monto_cons name="monto_consig" value="<?php if(isset($monto)) echo $monto;?>">
</div>
<input type="submit" name="botonMonto" value="Crear cuenta de ahorro">
</form>
<form action="v_clientePrincipal.php">
<input type="submit" name=volver value="Volver">
</form>
<?php
if(isset($_POST['botonMonto'])){
    if(!empty($_POST['monto_consig']) && is_numeric($_POST['monto_consig'])){
        $monto=$_POST['monto_consig'];
        echo cliente::crearCuentaAhorro($monto);
    }
    else{
        echo "Debe insertar algun valor en al casilla de monto y debe ser un numero" ;
    }
   
        
}


?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>