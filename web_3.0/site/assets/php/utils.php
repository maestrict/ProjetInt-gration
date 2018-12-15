<?php

function distinct_key($tableau, $on){
    $data = [];
    foreach($tableau as $value => $key){
        if ( !in_array($tableau[$value][$on], $data) ) {
            array_push($data, $tableau[$value][$on]);
        }
    }
    return $data;
}

function mailTo(){
    $to      = 'contact@moovego.be';
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $headers = "From: ".$_POST['email']. "\r\n" .
        "Reply-To: ".$_POST['email']. "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
}