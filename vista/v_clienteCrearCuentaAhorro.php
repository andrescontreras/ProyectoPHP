<?php
session_start();
include ("C:/xampp/htdocs/ProyectoPHP/controlador/c_cliente.php");
$usuario = cliente::nomUsuario();
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
<?php
if(isset($_POST['botonMonto'])){
    $monto=$_POST['monto_consig'];
    echo cliente::crearCuentaAhorro($monto);
        
}


?>
</body>
</html>