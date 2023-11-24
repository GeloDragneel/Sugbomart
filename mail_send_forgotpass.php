<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';
    
    $mail = new PHPMailer(TRUE);
    $mail->SMTPDebug = 0;
    
    $EmailAddress = $_POST['Email'];

    $SMTPOptionsSSL = array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    );
    
    $mail->SMTPOptions = array('ssl' => $SMTPOptionsSSL);
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'sewcut.web@gmail.com';
    $mail->Password = 'znmmwdlemkrxbqcb';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('ironbulwark31@gmail.com', 'Sugbomart'); 
    $mail->addReplyTo('ironbulwark31@gmail.com', 'Sugbomart'); 

    $mail->addAddress($EmailAddress); 
    $mail->isHTML(true);

    $mail->Subject = 'Sugbomart Forgot Password'; 

    $bodyContent = 'Forgot Password'; 
    $bodyContent .= '<h2>Your New Password : 123456</h2>'; 
    $mail->Body = $bodyContent; 
    $result = "";
    if(!$mail->send()) { 
        $result = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
    } 
    else { 
        $result = 'Success'; 
    }
    echo json_encode(array(
        'Result' => $result,
        'Email'  => $EmailAddress
    ));


?>