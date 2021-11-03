<?php 
require '../config.php';
require_once '../utils/connectdb.php';
require '../model/task.php';
require '../model/mail.php';

$tasked= R::findall('tasked');
$now = new DateTime('Today');
$now->setTime(0, 0, 0, 0);

foreach ($tasked as $t){
    
    $date = new DateTime($t->start);
    if($date == $now){   
      sendmail($t);
    }
}

?>