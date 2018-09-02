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
  </head>
  <body>
    <h1>Consignar a crédito</h1>
    <?php
    if (!empty($errCedula))
    {
      echo "<span style='color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errCedula."</span><br>";
    }
    if (!empty($errCorreo))
    {
      echo "<span style='color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errCorreo."</span><br>";
    }
     ?>
    <form action="v_VisitanteConsignarCredito.php" method="post">
      Cédula: <input type="text" name="visCedula">
      Correo: <input type="text" name="visCorreo">
      <input type="submit" name="visConsignarCredito" value="entrar">
    </form>
  </body>
</html>
