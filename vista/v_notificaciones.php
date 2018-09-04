<?php
  include_once("../controlador/c_cliente.php");
  include_once("../modelo/m_banco.php");
  session_start();
  $admin = cliente::esAdmin($_SESSION['usuario']);
  $n_notificaiones = 0;
  if ($admin == true)
  {
    $n_notificaiones =  cliente::noLeidos(-1);
  } else {
    $n_notificaiones =  cliente::noLeidos($_SESSION['usuario']);
  }


 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/styles.css">
  </head>
  <body>
    <div class="navegador">
      <nav>
        <a href="v_page.php">Pagina principal</a>
        <?php echo "<a href='v_notificaciones.php' class = 'gold_plating' data-notificaciones='$n_notificaiones'  > Notificaciones </a> ";?>
      </nav>
    </div>
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
