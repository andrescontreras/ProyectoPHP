<?php
require_once ('../PHPMailer/PHPMailerAutoload.php');
        
        echo "Se creo la persona";
        $correo = $_POST["correo"];
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='ssl';
        $mail->Host='smtp.gmail.com';
        $mail->Port= '465';
        $mail->isHTML();
        $mail->Username='prowebphp@gmail.com';
        $mail->Password='php12345';
        $mail->SetFrom('no-reply@proweb.org');
        $mail->Subject='Registro completo';
        $mail->Body='Se registro la persona al sistema';
        $mail->AddAddress($correo);
        $mail->Send();
       
        // enviar correo
        echo "Para acceder al gestion de archivos copie en su navegador lo siguiente: http://localhost/gestor.html";   

?>