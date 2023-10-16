<?php

/*
 * ------------------------------------
 * Contact Form Configuration
 * ------------------------------------
 */
 
$to    = "leon.sayasack@gmail.com"; // <--- Your email ID here


/*
 * ------------------------------------
 * END CONFIGURATION
 * ------------------------------------
 */
 
 $name     = $_REQUEST["name"];
 $email    = $_REQUEST["email"];
 $phone    = $_REQUEST["phone"];
 $location = $_REQUEST["location"];
 $subject  = $_REQUEST["subject"];
 $message  = $_REQUEST["message"];
 
 if (isset($email) && isset($name) && isset($location) && isset($subject)) {
     $website = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
     $headers = "MIME-Version: 1.0" . "\r\n";
     $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
     $headers .= "From: ".$name." <".$email.">\r\n"."Reply-To: ".$email."\r\n" ;
     $subject = $location . " - " . $subject;  // Combining location and subject
     $msg     = "Hello Thai Esane, <br/> <br/> You've got a message from $name ($email)<br/><br/>Message: $message <br><br> -- <br>This e-mail was sent from a contact form on $website";
   
     $mail =  mail($to, $subject, $msg, $headers);
     if($mail)
     {
         echo 'success';
     }
     else
     {
         echo 'failed';
     }
 }

?>