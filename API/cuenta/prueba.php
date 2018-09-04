<?php
// Ver el ejemplo de password_hash() para ver de dónde viene este hash.
$clave = "el";
echo $clave1 = password_hash($clave, PASSWORD_DEFAULT);
//$clave1 = '$2y$10$K5shSKMIXR9JxXgr4VeOceYGHc53YBJQVd5eS3Hq7OvLMaTRwPQZ2';
$clave2 = "el";
if(password_verify($clave2, $clave1))
{
echo "CORRECTO";
}
else{
echo "INCORRECTO";
}
?>