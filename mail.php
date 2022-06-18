<?php
require'PHPMailer/src/PHPMailer.php';
require'PHPMailer/src/SMTP.php';
require'PHPMailer/src/OAuth.php';
// require'PHPMailer/src/OAuthTokenProvider.php';
require'PHPMailer/src/Exception.php';
require'PHPMailer/src/POP3.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function sendmail_2($email, $name, $title, $content, $file_to_attach){
    $mail = new PHPMailer(true);

    try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'testlaptrinh0811@gmail.com';                     //SMTP username
    $mail->Password   = 'iamtrung';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->SMTPSecure = "tls";
    $mail->CharSet = "UTF-8";

    //Recipients
    $mail->setFrom('testlaptrinh0811@gmail.com', 'Trung');
    $mail->addAddress($email, $name);     //Add a recipient
  

    
    
    


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $title;
    $mail->Body    = $content;

    $mail->AddAttachment($file_to_attach);


    $mail->send();

    header('location: index.php');

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
} 
}

function sendmail_1($email, $name, $title, $content){
    $mail = new PHPMailer(true);

    try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'testlaptrinh0811@gmail.com';                     //SMTP username
    $mail->Password   = 'iamtrung';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->SMTPSecure = "tls";
    $mail->CharSet = "UTF-8";

    //Recipients
    $mail->setFrom('testlaptrinh0811@gmail.com', 'Trung');
    $mail->addAddress($email, $name);     //Add a recipient
  

    
    
    


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $title;
    $mail->Body    = $content;



    $mail->send();

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
} 
}

