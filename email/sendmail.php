<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

// obtener el token y el correo desde registrar.php
$email = $_POST['email'];
$user = new Usuarios();
//obtener el token desde fanlupaz_funciones.php
$token = $user->generar_token($_POST['email']);

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'kirsshacofran@gmail.com';                     //SMTP username
    $mail->Password   = 'vmgpiwqxgddpurpo';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('kirsshacofran@gmail.com', 'Shakirs Franco');
    $mail->addAddress($email, 'Joe User');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Clave de inicio de sesion';
    //$mail->Body    = 'Este es tu correo de deoble autenticacion </b>';
    // mensaje de confirmacion de registro de toke

    $mail->Body = "<h1>Este es tu correo de deoble autenticacion</h1>

    <p>Este es tu token:.$token</p> ";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    //pop up de confirmacion de envio de email
    //echo "<script>alert('Se ha enviado un email de confirmacion a su cuenta de correo')</script>";
} catch (Exception $e) {
    //pop up de error de envio de email
    echo "<script>alert('No se ha podido enviar el email de confirmacion a su cuenta de correo')</script>";
}
?>