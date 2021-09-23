<?php 
require '../config.php';
include '../utils/connectdb.php';
require('../model/task.php');

$tasked= R::findall('tasked');
$now = new DateTime('Today');
$now->setTime(0 , 0, 0 , 0);

foreach ($tasked as $t){
    $date = new DateTime($t->start);
    if($date == $now){        
        $message = "Vous devez " . $t->task->name . " le " . $date->format('d m Y') . '.\n' .
                   "Visitez http://task-manager pour avoir accès à la plannification complète";

        $headers = array(
            'From' => 'noreply@battenberg.ch',
            'Reply-To' => 'noreply@battenberg.ch',
            'X-Mailer' => 'PHP/' . phpversion()
        );
        
        if (mail($t->user->email, $t->task->name, $message, $headers)){
            echo "Message accepted";
        }
        else
        {
            echo "Error: Message not accepted";
        }
    }
}
?>