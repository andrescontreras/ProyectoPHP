<?php
session_start();
include ("C:/xampp/htdocs/ProyectoPHP/controlador/c_cliente.php");
?>
<html>
<body>
 <form action="" method="get">
 <div>
 <label for="">Monto a retirar</label>
 <input type="text" name="monto" value =0>
 </div>
 <div>
 <input type="submit" name="retirarMonto" value="Retirar el monto">
 </div>
 </form>
<?php  
if(isset($_GET['retirarMonto'])){
    echo cliente::retirar($_GET['monto']); 
} 
?>
<div>
<form action="v_clienteMenuCAhorro.php">
<input type="submit" value="Volver">
</form>
</div>
</body>
</html>