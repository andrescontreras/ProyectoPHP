<?php
session_start();
//echo "HJOLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA";
include_once "../controlador/c_cliente.php";
include_once "../controlador/c_correo.php";
//correo::enviarCorreo("santiagosw18@gmail.com","Prueba","Esto es una prueba de mandar un correo por PHP");
$idUsu = cliente::datosUsuario_ID("DASH");
$_SESSION['usuario']=$idUsu;
$usuario = cliente::nomUsuario();
$n_notificaiones =  cliente::noLeidos($_SESSION['usuario']);

//Si no funciona con COOKIE utilizar session
//setcookie("usuario",$idUsu,time()+3600);
//echo $_COOKIE["usuario"]."<br>";

//echo cliente::datosCuentaAhorro();

//$idUsu = cliente::datosUsuario_ID($_POST['usuario']);
?>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <div class="navegador">
    <nav>
      <a href="v_clientePrincipal.php">Pagina principal</a>
      <?php echo "<a href='v_notificaciones.php' class = 'gold_plating' data-notificaciones='$n_notificaiones'  > Notificaciones </a> ";?>
    </nav>
  </div>

<form action="v_clienteCrearCuentaAhorro.php" method="post">
<div>
<label for="txtNomUsuario">Nombre del usuario </label>
<input type ="text" name="nomUsuario" id="txtNomUsuario" value="<?php if(isset($usuario))echo $usuario?>">
</div>
<div>
<input type="submit" name="crear_cuenta_ahorro" value="Crear cuenta de ahorro">
</div>
</form>
<div>
<form action="v_clienteCrearTarjetaCredito.php" method="post">
<input type="submit" name="crear_tarjetacredito" value="Crear tarjeta de credito">
</div>
</form>
<div>
<form action="v_clienteSolicitarCredito.php" method="post">
<input type="submit" name="pedir_credito" value="Solicitar credito">
</form>
</div>
<div>
<form action="v_clienteMenuCAhorro.php" method="get">
<label for="cuentasR">Cuentas de ahorro</label>
<select name="cuentasAhorro" id="cuentasR">
<?php
echo cliente::datosCuentaAhorro();
?>
</select>
<input type="submit" value ="Seleccionar" name ="selecAhorro">
</form>
</div>
<form action="v_clienteMenuTCredito.php">
<div>
<label for="cuentasCl">Tarjetas de credito</label>
<select name="tarjetasCredito" id="cuentasCl">
<?php
// -------------------------------------> PARTE DE CONSIGNAR
echo cliente::datosTarjetaCredito();
?>
</select>
<input type="submit" value ="Seleccionar" name ="selecTCredito">
</div>
</form>

</body>
</html>
