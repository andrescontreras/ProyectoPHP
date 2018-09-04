<!-- es ta pantalla se encarga de modificar todos los datos globales del banco -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<body>
    <h3>Editar tarjeta de credito</h3>
    <?php
    include_once "../controlador/c_adminEditTarjetaC.php";
    session_start();
    if ($_SESSION['id_admin']) {
      $editT = new c_adminEditTarjetaC();
      $editT->getDatosTarjeta();
      $_SESSION['id_tarjeta_c'] = $_GET['tarjeta_c'];
    } else {
      header("Location: v_ERROR.php");
    }
    ?>

    <?php
    if (isset($_GET['guardar'])) {

      $cuota_manejo = $_GET['cuota_manejo'];
      $cupo = $_GET["cupo"];
      $sobrecupo = $_GET["sobrecupo"];
      $tasa_interes = $_GET["tasa_interes"];
      $estado = $_GET["estado"];
      $id_tarjeta = $_GET["tarjeta_c"];
      $editT->setDatosTarjeta($cuota_manejo, $cupo, $sobrecupo, $tasa_interes, $estado, $id_tarjeta);

    }

    ?>

    <form action="" method="get">
    <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Tarjeta a modificar</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" readonly  name="tarjeta_c" value="<?php echo $_GET['tarjeta_c'] ?>">
    </div>
  </div>
    <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Cuota de manejo</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  name="cuota_manejo" value="<?php echo $editT->datos[1] ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Cupo</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  name="cupo" value="<?php echo $editT->datos[4] ?>">
    </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Sobrecupo</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="sobrecupo" value="<?php echo $editT->datos[5] ?>">
    </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Tasa interes</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  name="tasa_interes" value="<?php echo $editT->datos[6] ?>">
    </div>
    </div>
  </div>

  <div class="form-group col-md-3">
    <label for="exampleFormControlSelect1">Estado de la tarjeta</label>
    <select class="form-control" id="exampleFormControlSelect1" name="estado" value ="<?php echo $editT->datos[7] ?>">
      <option>APROBADO</option>
      <option>RECHAZADO</option>
    </select>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      
      <input type="submit" class="btn btn-info btn-md" name="guardar" value="guardar">
    </div>
  </div>
  
</form>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>