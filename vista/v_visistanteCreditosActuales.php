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


      if ( $monto > c_visitante::mostrarMontoCredito($_POST['visAhorros']))
      {
        $done = "Se le descontaron $". c_visitante::mostrarMontoCredito($_POST['visAhorros']) . "<br>";
      }
      else {
        $done = "Se le descontaron $". $monto . "<br>";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="display-3">Creditos pendientes</h1>
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

      <div class="form-group">
        <label>Creditos</label>
        <select name="visAhorros" class="form-control-sm">
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
      </div>
      <div class="form-group">
        <label>Monto</label>
        <input class="form-control-sm" type="text" name="visMonto">
        <select class="form-control-sm" name="moneda">
          <option value="1">Pesos</option>
          <option value="2">Javecoins</option>
        </select>
      </div>
      <input class="btn btn-primary" type="submit" name="visConsignar" value="consignar">
    </form>
    <button style="margin-top:20px" class="btn btn-primary" type="button" onclick="window.location.href ='v_VisitanteConsignarCredito.php'">Volver</button>
  </body>
</html>
