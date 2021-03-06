<?php
include_once '../controlador/c_visitante.php';
 $errCedula = "";
 $errCorreo = "";
 $errIdCuenta = "";
 $errMonto = "";
 $err = false;
 $done = "";
 $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
 if ( isset($_POST['visConsignarAhorros']) )
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
    if (empty($_POST['visCorreo']))
    {
        $errCorreo = "Por favor ingrese un correo.";
        $err = true;
    }else if (!preg_match($pattern,$_POST['visCorreo'])) {
       $errCorreo = "Por favor ingrese un formato valido de coreo.";
       $err = true;
    }
    if (empty($_POST['visIdCuenta']))
    {
       $errIdCuenta = "Por favor ingrese el id de una cuenta.";
       $err = true;
    }else if ( !(preg_match("/^[0-9]+$/",$_POST['visCedula'])) ) {
      $errIdCuenta = "El id de la cuenta solo puede contener números.";
      $err = true;
    }
    if ( empty($_POST['visMonto']))
    {
      $errMonto = "Por favor ingrese un monto.";
      $err = true;
    }
    else if ( $_POST['visMonto'] <= 0 )
    {
      $errMonto = "Ingrese un monto valido.";
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
       $consulta = c_visitante::validarId($_POST['visIdCuenta']);
       if ($consulta->num_rows != 0)
       {
          c_visitante::consignarC_Ahorros($_POST['visIdCuenta'],$_POST['visCedula'],$_POST['visCorreo'],$monto);
          $done = "Se realizo con exito la consignación.";
       }
       else {
         $errIdCuenta = "No hay una cuenta asociada al ID ". $_POST['visIdCuenta'];
       }
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
  </head>
  <body>
    <h1 class="display-3">Consignar en cuenta de ahorros</h1>
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
      if (!empty($errMonto))
      {
        echo "<span style='border-radius: 5px; color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errMonto."</span><br>";
      }
      if (!empty($errIdCuenta))
      {
        echo "<span style='border-radius: 5px; color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errIdCuenta."</span><br>";
      }
      if (!empty($done))
      {
        echo "<span style='border-radius: 5px; color:rgb(7, 64, 5);border-style:inset;background-color: rgba(13, 193, 36, 0.57);' >".$done."</span><br>";
      }
     ?>
    <form action="" method="post">
      <div class="form-group">
        <label>Cedula</label>
        <input class="form-control-sm" type="text" name="visCedula">
      </div>
      <div class="form-group">
        <label>Correo</label>
        <input class="form-control-sm" type="email" name="visCorreo">
      </div>
      <div class="form-group">
        <label>IdCuenta</label>
        <input class="form-control-sm" type="text" name="visIdCuenta">
      </div>
      <div class="form-group">
        <label>Monto</label>
        <input class="form-control-sm" type="number" name="visMonto">
        <select class="form-control-sm" name="moneda">
          <option value="1">Pesos</option>
          <option value="2">Javecoins</option>
        </select>
      </div>
      <input class="btn btn-primary" type="submit" name="visConsignarAhorros" value="Consignar">
    </form>

  </body>
</html>
