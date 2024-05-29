<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require_once 'PHPMailer/src/Exception.php';
    require_once 'PHPMailer/src/PHPMailer.php';
    require_once 'PHPMailer/src/SMTP.php';

  
    function sendMail($email, $sub, $body) {
    $mail = new PHPMailer(true);
    
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $GLOBALS['hostEmail'];
    $mail->Password   = $GLOBALS['hostPassword'];
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    
    $mail->setFrom($GLOBALS['hostEmail'], $GLOBALS['hostName']);
    

    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = $sub;
    $mail->Body    = $body;
    try {
        $mail->send();
        // echo "sent";
    } catch (\Throwable $th) {
        echo "not-sent";
    }
  }

?>