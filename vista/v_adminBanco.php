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

<h3>Modificar valores del banco</h3>
<?php 
  include ("../controlador/c_adminBanco.php");
  session_start();
if ($_SESSION['id_admin']) {
   $banco = new c_adminBanco();
   $banco->getDatosBanco();
   echo $banco->nombreBanco;
   echo $banco->cuota_manejo;
   echo $banco->interes_mora;
   echo $banco->interes;
  } else {
    header("Location: v_ERROR.php");
}
?>

<?php
if(isset($_GET['guardar'])){
    $cuota_manejo=$_GET['cuota_manejo'];
    $interes = $_GET["interes"];
    $cuota_operacion= $_GET["costo_operacion"];
    $interes_mora= $_GET["interes_mora"];
    $nombre= $_GET["nombre_banco"];
    echo  $banco->setDatosbanco($cuota_manejo,$interes,$cuota_operacion,$interes_mora,$nombre);
}
    
?>
    <form action="" method="get">
    <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Cuota de manejo</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  name="cuota_manejo" value="<?php echo $banco->cuota_manejo; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Interes</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="interes" value="<?php echo $banco->interes; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Costo operacion</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  name="costo_operacion" value="<?php echo $banco->costo_operacion; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Interes mora</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  name="interes_mora" value="<?php echo $banco->interes_mora; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Nombre del banco</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  name="nombre_banco" value="<?php echo $banco->nombreBanco; ?>">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <input type="submit" name="guardar" value="Guardar">
    </div>
  </div>
  
</form>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>