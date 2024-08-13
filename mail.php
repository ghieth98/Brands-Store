<?php
/**
 * @return PHPMailer
 */
function requirePHPMailer(): PHPMailer
{
    require "Mail/phpmailer/PHPMailerAutoload.php";
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    //Our Credentials
    $mail->Username = '';
    $mail->Password = '';
    return $mail;  // Password from Google
}