<!-- esta es la pantalla principal del administrador -->
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
    <h1 >panel de administración</h1>
    <form action="v_adminBanco.php" method="get">
       <label for="">Valores del banco <input type="submit" value="Modificar"></label>
    </form>

     <form action="v_adminCliente.php" method="get">
       <label for="">
        Usuarios clientes:
        <select name="operacion" id="operacion">
            <option value="s">SUMA</option>
            <option value="r">RESTA</option>
            <option value="m">MULTIPLICACION</option>
            <option value="d">DIVISION</option>
        </select>
        <input type="submit" value="Entrar">
       </label>
    </form>
    <br>
    
    <form action="v_adminVisitante.php" method="get">
       <label for="">
        Usuarios visitantes:
        <select name="operacion" id="operacion">
            <option value="s">SUMA</option>
            <option value="r">RESTA</option>
            <option value="m">MULTIPLICACION</option>
            <option value="d">DIVISION</option>
        </select>
        <input type="submit" value="Entrar">
       </label>
    </form>
</body>
</html>