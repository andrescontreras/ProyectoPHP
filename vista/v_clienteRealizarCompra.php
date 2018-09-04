<?php
session_start();
include_once "../controlador/c_cliente.php";
if (!$_SESSION['nombre_cliente']) {
    header("Location: v_ERROR.php");
}
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
</body>
</html>