<?php
  include("../controlador/c_visitante.php");
  $errMonto = "";
  $errCedula = "";
  $errCorreo = "";
  $err = false;
  $done = "";
  $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
  if ( isset($_POST['visSolicitarCredito']) )
  {
    if ( empty($_POST['visMonto']) )
    {
      $errMonto = "Por favor ingrese un monto para solicitar el crédito.";
      $err = true;
    }else if ( !(preg_match("/^[0-9]*$/", $_POST['visMonto'])) )
    {
      $errMonto = "El monto solo puede contener numeros";
      $err = true;
    }
    if ( empty($_POST['visCedula']) )
    {
      $errCedula = "Por favor ingrese un monto para solicitar el crédito.";
      $err = true;
    }else if ( !(preg_match("/^[0-9]*$/",$_POST['visCedula'])) )
    {
      $errCedula = "La cédula solo puede contener numeros.";
      $err = true;
    }
    if ( empty($_POST['visCorreo']))
    {
      $errCorreo = "Ingrese un correo por favor";
      $err = true;
    }
    else if ( !preg_match($pattern,$_POST['visCorreo']) )
    {
      $errCorreo = "Ingrese un formato valido de correo.";
      $err = true;
    }
    if ( $err == false )
    {
      $done = "Credito solicitado.";
      if ($_POST['moneda'] == 1)
      {
        $monto = $_POST['visMonto']/1000;
      }
      else {
        $monto = $_POST['visMonto'];
      }
      c_visitante::solicitarCredito($monto,$_POST['visCorreo'],$_POST['visCedula']);
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
    <h1 class="display-3">Solicitar Crédito</h1>
    <div>
      <nav class="nav">
        <a class="nav-link active" href="v_VisitanteSolicitarCredito.php">Solicitar crédito</a>
        <a class="nav-link active" href="v_VisitanteConsignarCredito.php">Consignar crédito</a>
        <a class="nav-link active" href="v_VisitanteConsignarC_ahorro.php">Consignar a cuenta de ahorros</a>
      </nav>
    </div>
    <?php
      if ($errCedula != "")
      {
       echo "<span style='border-radius: 5px; color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errCedula."</span><br>";
      }
      if ($errCorreo != "")
      {
       echo "<span style='border-radius: 5px; color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errCorreo."</span><br>";
      }
      if ($errMonto != "")
      {
       echo "<span style='border-radius: 5px; color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errMonto."</span><br>";
      }
      if ( $done != "" )
      {
       echo "<span style='border-radius: 5px; color:rgb(7, 64, 5);border-style:inset;background-color: rgba(13, 193, 36, 0.57);' >".$done."</span><br>";
      }
     ?>
    <form action="v_VisitanteSolicitarCredito.php" method="post">
      <div class="form-group">
        <label>Monto </label>
        <input class="form-control-sm" type="text" name="visMonto">
        <select name="moneda" class="form-control-sm">
          <option value="1">Pesos</option>
          <option value="2">Javecoins</option>
        </select>
      </div>
      <div class="form-group">
        <label>Cédula</label>
        <input class="form-control-sm" type="text" name="visCedula">
      </div>
      <div class="form-group">
        <label>Correo</label>
        <input class="form-control-sm" type="email" name="visCorreo">
      </div>
      <input class="btn btn-primary" type="submit" name="visSolicitarCredito" value="Enviar">
    </form>
  </body>
</html>
