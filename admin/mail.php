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
        $message = "Vous devez " . $t->task->name . " le " . $date->format('d m Y') . '.\n';

        $headers = array(
            'From' => 'ramon.odermatt@lesjoux.ch',
            'Reply-To' => 'ramon.odermatt@lesjoux.ch',
            'X-Mailer' => 'PHP/' . phpversion()
        );
        mail($t->user->email, $t->task->name, $message, $headers);
    }
}
?>