<!-- es ta pantalla se encarga de modificar todos los datos globales del banco -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<?php include_once "../controlador/c_adminCliente.php";
session_start();
if ($_SESSION['id_admin']) {
    $admin = new c_adminCliente();
    $admin->getTajetas_c();
    $admin->getCreditos();
} else {
    header("Location: v_ERROR.php");
}

?>
<form action="v_adminEditTarjetaC.php" method="get">
       <label for="">
        tarjetas de credito del cliente:
        <select name="tarjeta_c" id="tarjeta_c">
        <?php
        foreach ($admin->tarjetas_c as $value) {
            echo "<option value=" . $value[0] . ">" . $value[0] . "</option>";
        }
        ?>
        </select>
        <input type="submit" class="btn btn-info btn-md" value="Entrar">
       </label>
    </form>
    <br>
    
    <form action="v_adminEditCredito.php" method="get">
       <label for="">
        creditos del cliente:
        <select name="credito" id="credito">
        <?php
        foreach ($admin->creditos as $value) {
            echo "<option value=" . $value[0] . ">" . $value[0] . "</option>";
        }
        ?>
        </select>
        <input type="submit" class="btn btn-info btn-md" value="Entrar">
       </label>
    </form>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>