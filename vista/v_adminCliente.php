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
<form action="v_adminEditTarjetaC.php" method="get">
       <label for="">
        tarjetas de credito del cliente:
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
    
    <form action="" method="get">
       <label for="">
        creditos del cliente:
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