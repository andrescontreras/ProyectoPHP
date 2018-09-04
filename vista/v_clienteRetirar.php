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
 <label  for="">Monto a retirar</label>
 <input type="text" name="monto" value =0>
 </div>
 <div>
 <input class="btn btn-primary mb-2" type="submit" name="retirarMonto" value="Retirar el monto">
 </div>
 </form>
<?php  
if(isset($_GET['retirarMonto'])){
    echo cliente::retirar($_GET['monto']); 
} 
?>
<div>
<form action="v_clienteMenuCAhorro.php">
<input class="btn btn-primary mb-2" type="submit" value="Volver">
</form>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>