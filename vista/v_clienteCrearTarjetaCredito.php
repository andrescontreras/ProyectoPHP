<?php 
session_start();
include ("C:/xampp/htdocs/ProyectoPHP/controlador/c_cliente.php");
?>
<html>
<body>
<form action="" method="post">
<label for="cuentasCl">Cuentas de ahorro</label>
<select name="cuentas" id="cuentasCl">
<?php
echo cliente::datosCuentaAhorro();
?>
</select>
<input type="submit" value="Solicitar tarjeta de credito" name="solicitar_tarjetacredito">
</form>
<form action="v_clientePrincipal.php">
<input type="submit" name="volver" value="Volver">
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
</body>
</html>