<?php

// Replace this with your own email address
$to = 'sohane.chamen@eemi.com';
$message = '';

function url(){
  return sprintf(
    "%s://%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME']
  );
}

if($_POST) {

   $firstname = trim(stripslashes($_POST['firstname']));
   $lastname = trim(stripslashes($_POST['lastname']));
   $email = trim(stripslashes($_POST['email']));
   $subject = trim(stripslashes($_POST['subject']));
   $contact_message = trim(stripslashes($_POST['message']));

   
	if ($subject == '') { $subject = "Contact Form Submission"; }

   // Set Message
   $message .= "Name: " . $firstname . " " . $lastname . "<br />";
   $message .= "Email address: " . $email . "<br />";
   $message .= "Message: <br />";
   $message .= nl2br($contact_message);
   $message .= "<br /> ----- <br /> This email was sent from your site " . url() . " contact form. <br />";

   // Set From: header
   $from =  $firstname . " " . $lastname . " <" . $email . ">";

   // Email Headers
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $email . "\r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

   ini_set("sendmail_from", $to); // for windows server
   $mail = mail($to, $subject, $message, $headers);

// Remplacez la ligne echo "OK"; par le code suivant
$response = array('status' => 'success', 'message' => 'Votre demande a bien été envoyée, merci !');
echo json_encode($response);

}

?>
