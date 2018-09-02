<?php
require_once ('../PHPMailer/PHPMailerAutoload.php');
class correo{
    public static function enviarCorreo($correo,$subject,$mensaje){
            echo "Se va a enviar el correo";
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
            $mail->Subject= $subject;
            $mail->Body= $mensaje;
            $mail->AddAddress($correo);
            $mail->Send();
    } 
}
        
?>