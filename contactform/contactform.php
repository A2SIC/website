<?php
/* 
    Advacned PHP contact form script 
    Copyrights BootstrapMade 
*/

/***************** Configuration *****************/

// Enter your email, where you want to receive the messages.
$contact_email_to = "a2sicasso@gmail.com";

// Subject prefix
$contact_subject_prefix = "[A2SIC] Nouvelle demande d'inscription";

// Name too short error text
$contact_error_name = "Nom trop court ou vide!";

// Email invalid error text
$contact_error_email = "Merci de saisir un email correct!";

// Subject too short error text
$contact_error_subject = "Subject is too short or empty!";

// Message too short error text
$contact_error_message = "Too short message! Please enter something.";

/********** Do not edit from the below line ***********/

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    // The Request must be Ajax POST, enter a message for direct access requests.
    die('Invalid Request!'); 
}

if( isset($_POST) ) {

    $name = filter_var($_POST["nom"], FILTER_SANITIZE_STRING);
    $prenom = filter_var($_POST["prenom"], FILTER_SANITIZE_STRING);
    $type = filter_var($_POST["type"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = $prenom." ".$name;
    
    $message = 
    "Prénom : ".$prenom. PHP_EOL.
    "Nom : ".$name. PHP_EOL.
    "Type : ".$type. PHP_EOL.
    "Mail : ".$email. PHP_EOL;
    
    if(strlen($name)<4){ 
        die($contact_error_name);
    }
    
    if(strlen($prenom)<3){ 
        die($contact_error_message);
    }
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){  
        die($contact_error_email);
    }
	
	
    $sendemail = mail($contact_email_to, $contact_subject_prefix.' '.$subject, $message,
         "From: ".$prenom." ".$name." <".$email.">" . PHP_EOL
        ."Reply-To: ".$email . PHP_EOL
        ."X-Mailer: PHP/" . phpversion()
    );
    
    if( $sendemail ) {
        echo 'OK';
    } else {
        echo 'Could not send mail! Please check your PHP mail configuration.';
    }
}
?>