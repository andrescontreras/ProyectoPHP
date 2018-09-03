<?php
// Ver el ejemplo de password_hash() para ver de dónde viene este hash.

echo $hash =  password_hash("conexionBanco",PASSWORD_DEFAULT);
    $hash11= '$2y$10$lUr8L1VQ2J0R4OZ64.Qvhe2/n790ka.KL3MfDkeO5D3vf1Nurp4zS';
if (password_verify('conexionBanco', $hash11)) {
    echo '¡La contraseña es válida!';
} else {
    echo 'La contraseña no es válida.';
}
?>