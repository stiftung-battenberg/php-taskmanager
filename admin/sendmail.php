<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../config.php';
require_once '../utils/connectdb.php';
require '../model/task.php';
require '../model/mail.php';

require_once "../vendor/autoload.php";

$tasked= R::findall('tasked');
$now = new DateTime('Today');
$now->setTime(0 , 0, 0 , 0);

foreach ($tasked as $t){
    $date = new DateTime($t->start);
    if($date == $now){   
        try {
            $mail = new PHPMailer(true); 
            
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            
            $mail->Username = SMTP_USER; 
            $mail->Password = SMTP_PASS;

            $mail->SMTPSecure = 'ssl'; 
            $mail->Port = 465;
    
            $mail->Subject = $t->task->name;
            
            $body = getMail()->text;

            $body = str_replace('/name', $t->task->name, $body);
            $body = str_replace('/date', $t->start, $body);
            
            $mail->Body = $body;
            $mail->IsHTML(true);
                    
            $mail->addAddress($t->user->email, $t->user->name);
            $mail->send();
            echo 'Email has been sent';
        } catch (Exception $e) {
            echo 'Email could not be sent. Mailer Error: '. $mail->ErrorInfo;
        }
    }
}

?>