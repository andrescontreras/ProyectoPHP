<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<h3>Login para clientes</h3>
<form>
<div class ="col-6">
  <div class="form-group">
    <label for="exampleInputEmail1">Usuario</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Usuario">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<form action="vista/v_adminPrincipal.php" method="get">
<input class="btn btn-success m-1" type="submit" value="Entrar Admin">
</form>
<form  action="vista/v_clientePrincipal.php" method="get">
<input  class="btn btn-success m-1" type="submit" value="Entrar Cliente">
</form>
<form action="vista/v_clientePrincipal.php" method="get">
<input class="btn btn-success m-1"  type="submit" value="Entrar Visitante">
</form>
</div>
</body>
</html>