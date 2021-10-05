<?php

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


?>