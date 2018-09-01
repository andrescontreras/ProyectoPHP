
<html>
<body>
<?php
    
    
    //HECHO POR SANTIAGO SALAMANCA LEON  <---------------------------------------------------------------------------------------


include_once dirname(__FILE__) . '/config.php';
$con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
if (mysqli_connect_errno()) {
    echo "Error en la conexión: " . mysqli_connect_error();
}
$sql ="DROP TABLE c_ahorro";
if (mysqli_query($con, $sql)) {
    
}
$sql ="DROP TABLE credito";
if (mysqli_query($con, $sql)) {
    
}
$sql ="DROP TABLE tarjeta_credito";
if (mysqli_query($con, $sql)) {
    
}

$sql="CREATE DATABASE IF NOT EXISTS mibd";
if (mysqli_query($con,$sql)) {
//echo " mibd creada";
}else {
//echo "Error " . mysqli_error($con);
}


$sql ="CREATE TABLE IF NOT EXISTS usuario(ID INT NOT NULL AUTO_INCREMENT,PRIMARY KEY(ID),Usuario CHAR(25) NOT NULL,Password CHAR(40) NOT NULL, Tipo CHAR(20))";
if (mysqli_query($con, $sql)) {
    //echo "Tabla Usuarios creada correctamente";
}

//Una cuenta de ahorro solo la pueden tener Clientes
//Owner va a contener el nombre de usuario del cliente
//Los administradores pueden cambiar el atributo: JaveCoins
$sql ="CREATE TABLE IF NOT EXISTS c_ahorro(ID INT NOT NULL AUTO_INCREMENT,PRIMARY KEY(ID),Owner CHAR(25) NOT NULL,JaveCoins INT)";
if (mysqli_query($con, $sql)) {
    //echo "Tabla Usuarios creada correctamente";
}

//Un credito lo pueden obtener Clientes y Visitantes
//Para las tarjetas credito se utiliza OwnerEmail cuando es visitante y Owner(ID del cliente) cuando es cliente
//El estado va a decir si el credito que se solicito fue aceptado, rechazado o modificado por el administrador
//Los administradores pueden cambiar los atributos: Monto, Interes, Estado e FechaPago
$sql ="CREATE TABLE IF NOT EXISTS credito(ID INT NOT NULL AUTO_INCREMENT,PRIMARY KEY(ID),OwnerEmail CHAR(50),Owner CHAR(25),Monto INT,Interes INT, Estado CHAR(20), FechaPago Date)";
if (mysqli_query($con, $sql)) {
    //echo "Tabla Usuarios creada correctamente";
}

//Una tarjeta de credito solo la puede obtener un cliente
//Los administradores deben colocar los atributos: Estado, Cupo, Sobrecupo, CuotaManejo e Interes
$sql ="CREATE TABLE IF NOT EXISTS tarjeta_credito(ID INT NOT NULL AUTO_INCREMENT,PRIMARY KEY(ID),Owner CHAR(25),c_ahorro INT, Estado CHAR(20),Cupo INT, Sobrecupo INT, CuotaManejo INT, Interes INT)";
if (mysqli_query($con, $sql)) {
    //echo "Tabla Usuarios creada correctamente";
}

$sql = "INSERT INTO c_ahorro (Owner, JaveCoins) VALUES ('cliente', 1000)";
if (mysqli_query($con, $sql)) {
    //echo "Tabla Usuarios creada correctamente";
}
$sql = "INSERT INTO c_ahorro (Owner, JaveCoins) VALUES ('cliente2', 5000)";
if (mysqli_query($con, $sql)) {
    //echo "Tabla Usuarios creada correctamente";
}
$sql = "INSERT INTO tarjeta_credito (Owner,c_ahorro,Estado,Cupo) VALUES ('cliente2', 1,'ACEPTADA',10000)";
if (mysqli_query($con, $sql)) {
    //echo "Tabla Usuarios creada correctamente";
}
$sql = "INSERT INTO tarjeta_credito (Owner,c_ahorro,Estado,Cupo) VALUES ('cliente2', 1,'ACEPTADA',15000)";
if (mysqli_query($con, $sql)) {
    //echo "Tabla Usuarios creada correctamente";
}


if(isset($_POST['crear_usuario']) || isset($_POST['ingresar'])){
$usuario= $_POST['usuario'];
$clave= $_POST['clave'];
$cedula2= $_POST['cedula2'];
}
?>
    <form action="" method="post">
        <div>
            <label for="txtCedula">Cedula</label>
            <input type="text" name="cedula" id="txtCedula" value="<?php if(isset($cedula)) echo $cedula ?>">
        </div>
        <div>
            <label for="txtNombre">Nombre</label>
            <input type="text" name="nombre" id="txtNombre" value="<?php if(isset($nombre)) echo $nombre ?>">
        </div>
        <div>
            <label for="txtApellido">Apellido</label>
            <input type="text" name="apellido" id="txtApellido" value="<?php if(isset($apellido)) echo $apellido ?>">
        </div>
        <div>
            <label for="txtCorreo">Correo</label>
            <input type="text" name="correo" id="txtCorreo" value="<?php if(isset($correo)) echo $correo ?>">
        </div>
        <div>
            <label for="txtEdad">Edad</label>
            <input type="text" name="edad" id="txtEdad" value="<?php if(isset($edad)) echo $edad ?>">
        </div>
        <input type="submit" name="submit" value="Agregar/Actualizar persona">
        <?php
        if(isset($_POST['submit'])){
            $flagnomb=true;
            $flagemail=true;
            $flagedad=true;
            if(!preg_match("/^[a-zA-Z ]*$/",$nombre)){
                echo"<p class='error'>* El nombre solo debe contener letras y espacios </p>";
                $flagnomb=false;
            }
            if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
                echo "<p class='error'>* El correo no esta escrito bien </p>";
                $flagemail=false;
            }
            if(!is_numeric($edad)){
                echo "<p class='error'>* La edad ingresada debe ser un numero </p>";
                $flagedad=false;
            }
            if($flagnomb && $flagemail && $flagedad){
                require("datos_post.php");
            }
        }
        ?>
        <input type="submit" name="borrar" value="Borrar">
        <?php
        if(isset($_POST['borrar'])){
        require("borrarPersona.php");
        }
        ?>
    </form>
    
    <br>
    <form action="metodos_usuario.php" method="post">
    <div>
            <label for="txtUsuario">Usuario</label>
            <input type="text" name="usuario" id="txtUsuario" value="<?php if(isset($usuario)) echo $usuario ?>">
    </div>
    <div>
            <label for="txtClave">Contraseña</label>
            <input type="text" name="clave" id="txtClave" value="<?php if(isset($clave)) echo $clave ?>">
    </div>
        <input type="submit" name="crear_usuario" value="Crear usuario">
        <input type="submit" name="ingresar" value="Iniciar sesion">
    </form>
    <div>
    <a href="visitante.php">Ingresar como visitante</a>
    </div>
</body>
</html>