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
  </head>
  <body>
    <h1>Solicitar Crédito</h1>
    <?php
      if ($errCedula != "")
      {
       echo "<span style='color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errCedula."</span><br>";
      }
      if ($errCorreo != "")
      {
       echo "<span style='color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errCorreo."</span><br>";
      }
      if ($errMonto != "")
      {
       echo "<span style='color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errMonto."</span><br>";
      }
      if ( $done != "" )
      {
       echo "<span style='color:rgb(7, 64, 5);border-style:inset;background-color: rgba(13, 193, 36, 0.57);' >".$done."</span><br>";
      }
     ?>
    <form action="v_VisitanteSolicitarCredito.php" method="post">
      Monto: <input type="text" name="visMonto">
      <select name="moneda">
        <option value="1">Pesos</option>
        <option value="2">Javecoins</option>
      </select>
      Cédula: <input type="text" name="visCedula">
      Correo: <input type="email" name="visCorreo">
      <input type="submit" name="visSolicitarCredito" value="enviar">
    </form>
  </body>
</html>
