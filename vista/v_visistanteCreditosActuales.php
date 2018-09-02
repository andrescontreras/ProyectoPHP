<?php
  include_once '../controlador/c_visitante.php';
  session_start();
  $errAhorros = "";
  $errMonto = "";
  $err = false;
  $done = "";
  if (isset($_POST['visConsignar']))
  {
    if ($_POST['visAhorros'] == 0)
    {
      $errAhorros = "Seleccione un crédito";
      $err = true;
    }
    if ( empty($_POST['visMonto']))
    {
      $errMonto = "Por favor ingrese un monto";
      $err = false;
    }
    else if ( $_POST['visMonto'] <= 0 )
    {
      $errMonto = "Ingrese un monto valido";
      $err = true;
    }

    if ($err == false)
    {
      if ( $_POST['moneda'] == 1 )
      {
        $monto = $_POST['visMonto']/1000;
      }
      else {
        $monto = $_POST['visMonto'];
      }
      if ( $_POST['visMonto'] > c_visitante::mostrarMontoCredito($_POST['visAhorros']))
      {
        $done = "Se le descontaron $". c_visitante::mostrarMontoCredito($_POST['visAhorros']) . "<br>";
      }
      c_visitante::transaccionCredito( $_POST['visAhorros'], $monto, $_SESSION['visCedula'], $_SESSION['visCorreo']);

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
    <?php
      if (!empty($errAhorros))
      {
        echo "<span style='color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errAhorros."</span><br>";
      }
      if (!empty($errMonto))
      {
        echo "<span style='color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errMonto."</span><br>";
      }
      if (!empty($done))
      {
        echo "<span style='color:rgb(7, 64, 5);border-style:inset;background-color: rgba(13, 193, 36, 0.57);' >".$done."</span><br>";
      }
     ?>
    <form action="v_visistanteCreditosActuales.php" method="post">
      <select name="visAhorros">
        <option name="0" value="0">---</option>
        <!-->Aquí van las consultas de la base de datos</-->
        <?php
         if (isset($_SESSION['visCedula']))
         {
            $consultaCreditos = c_visitante::mostrarCreditos($_SESSION['visCedula']);
            while ($fila = mysqli_fetch_array($consultaCreditos))
            {
              $id = $fila['IDCREDITO'];
              $texto = "CC ". $fila['USUARIO']." $ ".$fila['MONTO']." javecoins";
              echo "<option name = '$id' value = '$id'>$texto</option>";
            }
         }
         ?>
      </select>
      Monto: <input type="text" name="visMonto">
      <select name="moneda">
        <option value="1">Pesos</option>
        <option value="2">Javecoins</option>
      </select>
      <input type="submit" name="visConsignar" value="consignar">
    </form>
  </body>
</html>
