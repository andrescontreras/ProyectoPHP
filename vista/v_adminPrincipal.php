<!-- esta es la pantalla principal del administrador -->
<?php

include_once "../controlador/c_adminFinMes.php";
include_once "../controlador/c_cliente.php";

session_start();
if (cliente::esAdmin($_SESSION['id_admin']))
  {
      $n_notificaiones = cliente::noLeidos($_SESSION['id_admin']);
  }else
  {
    $n_notificaiones = cliente::noLeidos($_SESSION['id_admin']);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


     <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1 >panel de administración</h1>
    <form action="v_adminBanco.php" method="get">
       <label for="">Valores del banco <input type="submit" value="Modificar"></label>
    </form>
    <div>
        <h3>Centro de mensajes</h3>
        <div class="navegador">
    <nav>
      <a href="v_clientePrincipal.php">Pagina principal</a>
      <?php echo "<a href='v_notificaciones.php' class = 'gold_plating' data-notificaciones='$n_notificaiones'  > Notificaciones </a> "; ?>
    </nav>
  </div>


    </div>
    <?php include_once "../controlador/c_adminPrincipal.php";
    if ($_SESSION['id_admin']) {
        $admin = new c_adminPrincipal();
        $admin->getUsuarios();
        $admin->getVisitantes();
        echo "SESSION: " . $_SESSION["id_admin"];
        $admin->admin = $_SESSION["id_admin"];
    } else {
        header("Location: v_ERROR.php");
    }

    ?>
     <form action="v_adminCliente.php" method="get">
       <label for="">
        Usuarios clientes:
        <select name="cliente" id="cliente">
            <?php
            foreach ($admin->usuarios as $value) {
                echo "<option value=" . $value[0] . ">" . $value[1] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Entrar">
       </label>
    </form>
    <br>
    
    <form action="v_adminVisitante.php" method="get">
       <label for="">
        Usuarios visitantes:
        <select name="visitante" id="visitante">
        <?php
        foreach ($admin->visitantes as $value) {
            echo "<option value=" . $value[6] . ">" . $value[1] . "</option>";
        }
        ?>
        </select>
        <input type="submit" value="Entrar">
       </label>
    </form>

    <form action="" method="get">
    <input id="datepicker" name="fecha" width="276" />
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
    <input type="text" name="fecha_pago" id="">
    <input type="submit" value="Fin de mes" name ="fin_mes">
    </form>
    <?php

    if (isset($_GET['fin_mes'])) {
        c_adminFinMes::findeMes($_GET['fecha_pago']);
    }

    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>