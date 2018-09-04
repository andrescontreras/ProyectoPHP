<?php
// Ver el ejemplo de password_hash() para ver de dónde viene este hash.
$clave = "nubo";
echo $clave1 = password_hash($clave, PASSWORD_DEFAULT);
//$clave1 = '$2y$10$K5shSKMIXR9JxXgr4VeOceYGHc53YBJQVd5eS3Hq7OvLMaTRwPQZ2';
$clave2 = "nubo";
if(password_verify($clave2, $clave1))
{
echo "CORRECTO";
}
else{
echo "INCORRECTO";
}

echo "<br><br><br><br>";

echo '$das';
echo "INSERT INTO USUARIO (USUARIO, PASSWORD, TIPO ) VALUES ('cocu', "."'".password_hash("nubo", PASSWORD_DEFAULT)."'".", 'CLIENTE')";
?>