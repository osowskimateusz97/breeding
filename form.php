<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
if(!empty($_POST['name']) and !empty($_POST['email']) and !empty($_POST['message'])){

    $email_odbiorcy = 'osowski.mateuszz@gmail.com'; 
    $header = 'Reply-To: <'.$_POST['email']."> \r\n";  
    $header .= "MIME-Version: 1.0 \r\n";  
    $header .= "Content-Type: text/html; charset=UTF-8";  
    $wiadomosc = "<p>Dostałeś wiadomość od:</p>"; 
    $wiadomosc .= "<p>Imie i nazwisko: " . $_POST['name'] . "</p>"; 
	 $wiadomosc .= "<p>Telefon: " . $_POST['phone'] . "</p>"; 
    $wiadomosc .= "<p>Email: " . $_POST['email'] . "</p>"; 
    $wiadomosc .= "<p>Wiadomość: " . $_POST['message'] . "</p>"; 
    $message = '<!doctype html><html lang="pl"><head><meta charset="utf-8">'.$wiadomosc.'</head><body>';
    $subject = 'Wiadomość ze strony...';
    $subject = '=?utf-8?B?'.base64_encode($subject).'?=';
    if(mail($email_odbiorcy , $subject, $message, $header)){ 
      die('Wiadomość została wysłana'); 
    }else{ 
      die('Wiadomość nie została wysłana'); 
    } 
  
}
else {
	die('Wiadomość nie została wysłana'); 
}
?>