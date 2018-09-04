<?php
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
  <?php include_once "../controlador/c_login.php";
  $login = new c_login();
  session_start();
  session_destroy();
  ?>
  <?php
  if (isset($_POST['ingresar'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    echo "<h1>ENTRO LOGIN</h1>";
    $login->iniciar();
  } elseif (isset($_POST['crear_usuario'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    echo "<h1>ENTRO LOGIN</h1>";
    $login->registrarse();
  }
  ?>
    
    <form action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Usuario</label>
    <input type="text" class="form-control"  name="usuario" id="txtUsuario" value="<?php if (isset($usuario)) echo $usuario ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control"name="clave" id="txtClave" value="<?php if (isset($clave)) echo $clave ?>">
  </div>
  <button type="submit" name="ingresar" value="Iniciar sesion" class="btn btn-primary">Iniciar sesion</button>
  <button type="submit" name="crear_usuario" value="Crear usuario" class="btn btn-primary">Registrarse</button>
</form>

    <form action="v_adminPrincipal.php" method="get">
<input class="btn btn-success m-1" type="submit" value="Entrar Admin">
</form>
<form  action="v_clientePrincipal.php" method="get">
<input  class="btn btn-success m-1" type="submit" value="Entrar Cliente">
</form>
<form action="v_visitantePrincipal.php" method="get">
<input class="btn btn-success m-1"  type="submit" value="Entrar Visitante">
</form>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
