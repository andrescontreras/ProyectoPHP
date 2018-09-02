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
  </head>
  <body>
    <h1>Consignar en cuenta de ahorros</h1>
    <?php
      if (!empty($errCedula))
      {
        echo "<span style='color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errCedula."</span><br>";
      }
      if (!empty($errCorreo))
      {
        echo "<span style='color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errCorreo."</span><br>";
      }
      if (!empty($errMonto))
      {
        echo "<span style='color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errMonto."</span><br>";
      }
      if (!empty($errIdCuenta))
      {
        echo "<span style='color:red;border-style:inset;background-color: rgba(219, 55, 38, 0.56);' >".$errIdCuenta."</span><br>";
      }
      if (!empty($done))
      {
        echo "<span style='color:rgb(7, 64, 5);border-style:inset;background-color: rgba(13, 193, 36, 0.57);' >".$done."</span><br>";
      }
     ?>
    <form action="" method="post">
      Cedula: <input type="text" name="visCedula">
      Correo: <input type="email" name="visCorreo">
      IdCuenta: <input type="text" name="visIdCuenta">
      Monto: <input type="number" name="visMonto">
      <select name="moneda">
        <option value="1">Pesos</option>
        <option value="2">Javecoins</option>
      </select>
      <input type="submit" name="visConsignarAhorros" value="Consignar">
    </form>
  </body>
</html>
