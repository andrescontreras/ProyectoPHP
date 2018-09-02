<?php
  include_once("../controlador/c_cliente.php");
  session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="container">
      <ul>
        <?php
          $consulta = cliente::mostrarNotificaciones($_SESSION['usuario']);
          if ($consulta->num_rows > 0)
          {
            while ($fila = mysqli_fetch_array($consulta))
            {
              $notificacion = $fila['MENSAJE'];
              echo "<li>$notificacion</li>";
            }
          } else
          {
            echo  "<li> Aun no tiene notificaciones.</li>";
          }
        ?>
      </ul>
    </div>
  </body>
</html>
