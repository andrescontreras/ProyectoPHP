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
<body>
<form action="" method="post">
<div>
<label for="txtUsu">Usuario</label>
<input type="text" name="usuario" id="txtUsu" value="<?php if(isset($usuario)){echo $usuario;} else{echo $nomUsuario;}  ?>">
</div>
<div>
<label for="monto_cons">Monto que quiere consignar</label>
<input type="text"  id=monto_cons name="monto_consig" value="<?php if(isset($monto)) echo $monto;?>">
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
</body>
</html>