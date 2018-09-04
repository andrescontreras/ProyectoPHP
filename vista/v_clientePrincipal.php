<?php
session_start();
//echo "HJOLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA";
include_once "../controlador/c_cliente.php";
//include_once "../controlador/c_correo.php";
//correo::enviarCorreo("santiagosw18@gmail.com","Prueba","Esto es una prueba de mandar un correo por PHP");
if ($_SESSION['nombre_cliente']) {
  $idUsu = cliente::datosUsuario_ID($_SESSION['nombre_cliente']);
  $_SESSION['usuario']=$idUsu;
  $usuario = cliente::nomUsuario();
  if (cliente::esAdmin($_SESSION['usuario']))
  {
      $n_notificaiones = cliente::noLeidos($_SESSION['usuario']);
  }else
  {
    $n_notificaiones = cliente::noLeidos($_SESSION['usuario']);
  }
}
else
{
  header("Location: v_ERROR.php");
}



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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
<label class="col-sm-2 col-form-label" for="txtNomUsuario">Nombre del usuario </label>
<input type ="text" class="form-control"  name="nomUsuario" id="txtNomUsuario" value="<?php if(isset($usuario))echo $usuario?>">
</div>
<div>
<input class="btn btn-primary mb-2" type="submit" name="crear_cuenta_ahorro" value="Crear cuenta de ahorro">
</div>
</form>
<div>
<form action="v_clienteCrearTarjetaCredito.php" method="post">
<input class="btn btn-primary mb-2" type="submit" name="crear_tarjetacredito" value="Crear tarjeta de credito">
</div>
</form>
<div>
<form action="v_clienteSolicitarCredito.php" method="post">
<input class="btn btn-primary mb-2" type="submit" name="pedir_credito" value="Solicitar credito">
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
<input class="btn btn-primary mb-2" type="submit" value ="Seleccionar" name ="selecAhorro">
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
<input class="btn btn-primary mb-2" type="submit" value ="Seleccionar" name ="selecTCredito">
</div>
</form>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
