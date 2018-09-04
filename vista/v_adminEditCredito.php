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
<body>
    <h3>Editar credito</h3>
    <?php
    include_once "../controlador/c_adminEditCredito.php";
    session_start();
    if ($_SESSION['id_admin']) {
      $editC = new c_adminEditCredito();
      $editC->getDatosCredito();
    } else {
      header("Location: v_ERROR.php");
    }


    ?>
    <?php
    if (isset($_GET['guardar'])) {

      echo $interes = $_GET["interes"];
      echo $estado = $_GET["estadoN"];
      echo $id_credito = $_GET["credito"];
      echo $editC->setDatosCredito($interes, $estado, $id_credito);

    }

    ?>
    <form action="" method="get">
    <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Credito a modificar</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  name="credito" readonly value="<?php echo $_GET['credito'] ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Estado actual</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="estadoA" readonly value="<?php echo $editC->datos[2] ?>">
    </div>
  </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Interes</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="interes" value="<?php echo $editC->datos[4] ?>">
    </div>
  </div>
  
  

  <div class="form-group col-md-3">
    <label for="exampleFormControlSelect1">Editar estado</label>
    <select class="form-control" name="estadoN">
      <option>APROBADO</option>
      <option>RECHAZADO</option>
    </select>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
    <input type="submit" name="guardar" value="guardar">
    </div>
  </div>
  

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</form>
</body>
</html>