<?php
// phpmailer files
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Values that the user sends
$name = $_POST['name'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Mail creation
$title = "Новое обращение в Best Tour Plan";
$body = "
<h2>Новое обращение</h2>
<b>Name:</b> $name<br>
<b>Phone:</b> $phone<br><br>
<b>Message:</b><br>$message
";

// Settings PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.gmail.com'; // SMTP server
    $mail->Username   = 'pamir235@gmail.com'; // Login your email
    $mail->Password   = 'sfg55gF3d'; // Password your email
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('pamir235@gmail.com', 'Андрей Харченко'); // Mail address itself and sender's name

    // Receiver of mail
    $mail->addAddress('pamir05@mail.ru');
    // One more, if you need
  
    // Sending a message
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;    

// Checking for poisoning
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Message was not sent. Cause of the error: {$mail->ErrorInfo}";
}

// Display result
header('Location: thankyou.html');