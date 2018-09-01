<?php
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  <?php
  if(isset($_POST['crear_usuario']) || isset($_POST['ingresar'])){
    $usuario= $_POST['usuario'];
    $clave= $_POST['clave'];
    }
  ?>
    <p>MUERTE A VS CODE</p>
    <h1>fgdsakjgfkuas gk</h1>
    <h2>cambio33333333</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
       Ut enim ad minim veniam, quis nostrud exercitation ullamco
       laboris nisi ut aliquip ex ea commodo consequat. Duis aute
       irure dolor in reprehenderit in voluptate velit esse cillum
        dolore eu fugiat nulla pariatur. Excepteur sint occaecat</p>
    <form action="" method="post">
    <div>
            <label for="txtUsuario">Usuario</label>
            <input type="text" name="usuario" id="txtUsuario" value="<?php if(isset($usuario)) echo $usuario ?>">
    </div>
    <div>
            <label for="txtClave">Contraseña</label>
            <input type="text" name="clave" id="txtClave" value="<?php if(isset($clave)) echo $clave ?>">
    </div>
        <input type="submit" name="crear_usuario" value="Crear usuario">
        <input type="submit" name="ingresar" value="Iniciar sesion">
    </form>
    <div>
    <a href="visitante.php">Ingresar como visitante</a>
    </div>
  </body>
</html>
