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
<input class="btn btn-primary mb-2" type="submit" value="Comprar" name="comprar">
</div>
</form>
<br>
<form action="v_clienteMenuTCredito.php">
<div>
<input  class="btn btn-primary mb-2" type="submit" value="Volver" name="volver">
</div>
</form>
<?php
if(isset($_GET['comprar'])){
    if( ( empty($_GET['cuotas']) || !(is_numeric($_GET['cuotas'])) ) && ( (empty($_GET['monto'])) || !(is_numeric($_GET['monto'])) ) && empty($_GET['descripcion']) ){
        echo "Debe colocar un valor en la casilla cuotas y debe ser un numero <br>";
        echo "Debe colocar un valor en la casilla monto y debe ser un numero <br>";
        echo "Debe colocar un valor en la casilla descripcion <br>";
    }
    else if(empty($_GET['cuotas'])){
        echo "Debe colocar un valor en la casilla cuotas y debe ser un numero<br>";
    }else if(empty($_GET['monto']) || !is_numeric($_GET['monto'])){
        echo "Debe colocar un valor en la casilla monto y debe ser un numero <br>";
    }
    else if(empty($_GET['descripcion'])){
        echo "Debe colocar un valor en la casilla descripcion <br>";
    }else{
    $cuotas =$_GET['cuotas'];
    $monto = $_GET['monto'];
    $descripcion = $_GET['descripcion'];
    echo cliente::realizarCompra($cuotas,$monto,$descripcion);
    }
    
}
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>