<?php
  include_once("../controlador/c_visitante.php");
  session_start();
  $errCedula = "";
  $errCorreo = "";
  $err = false;
  $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
  if ( isset($_POST['visConsignarCredito']) )
  {
    if ( empty($_POST['visCedula']) )
    {
      $errCedula = "Por favor ingrese un monto para solicitar el crédito.";
      $err = true;
    }else if ( !(preg_match("/^[0-9]+$/",$_POST['visCedula'])))
    {
      $errCedula = "La cédula solo puede contener numeros.";
      $err = true;
    }
    if ( empty($_POST['visCorreo']))
    {
      $errCorreo = "Ingrese un correo por favor";
      $err = true;
    }else if ( !preg_match($pattern,$_POST['visCorreo']) )
    {
      $errCorreo = "Ingrese un formato valido de correo.";
      $err = true;
    }
    if ( $err == false )
    {
      $_SESSION['visCedula'] = $_POST['visCedula'];
      $_SESSION['visCorreo'] = $_POST['visCorreo'];
      header( 'Location: v_visistanteCreditosActuales.php');
    }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="display-3">Consignar a crédito</h1>
    <div>
      <nav class="nav">
        <a class="nav-link active" href="v_VisitanteSolicitarCredito.php">Solicitar crédito</a>
        <a class="nav-link active" href="v_VisitanteConsignarCredito.php">Consignar crédito</a>
        <a class="nav-link active" href="v_VisitanteConsignarC_ahorro.php">Consignar a cuenta de ahorros</a>
      </nav>
    </div>
    <?php
    if (!empty($errCedula))
    {
      echo "<span style='border-radius: 5px; color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errCedula."</span><br>";
    }
    if (!empty($errCorreo))
    {
      echo "<span style='border-radius: 5px; color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errCorreo."</span><br>";
    }
     ?>
    <form action="v_VisitanteConsignarCredito.php" method="post">
      <div class="form-group">
        <label>Cédula</label>
        <input class="form-control-sm"type="text" name="visCedula">
      </div>
      <div class="form-group">
        <label>Correo</label>
        <input class="form-control-sm" type="text" name="visCorreo">
      </div>
      <input class="btn btn-primary" type="submit" name="visConsignarCredito" value="entrar">
    </form>
  </body>
</html>
