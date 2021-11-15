<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "../vendor/autoload.php";


function createDefaultMail ($text) {
    $mails = R::findAll( 'mail' );
    if($mails == []) {
        $mail = R::dispense( 'mail' );
        $mail->text = $text;
        $id = R::store( $mail );
    }
}

function getMail () {
    $mails = R::findAll( 'mail' );
    return $mails[1];
}

function updateMail ($text) {
    $mail = getMail(); 
    $mail->text = $text;
    R::store($mail);
}

function sendmail ($t) {
    try {
        $mail = new PHPMailer(true); 

        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        
        $mail->Username = SMTP_USER; 
        $mail->Password = SMTP_PASS;
        
        $mail->SMTPSecure = 'ssl'; 
        $mail->Port = SMTP_PORT;
        
        $mail->Subject = $t->task->name;
        
        $body = getMail()->text;
        
        $mail->CharSet = 'utf-8';
        $body = str_replace('/name', $t->task->name, $body);
        $body = str_replace('/date', (new DateTime($t->start))->format('d-m-y'), $body);
        
        $mail->Body = $body;
        $mail->IsHTML(true);
                
        $mail->addAddress($t->user->email, $t->user->name);
        $mail->send();
        echo 'Email has been sent';
    } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: '. $mail->ErrorInfo;
    }
}
?>