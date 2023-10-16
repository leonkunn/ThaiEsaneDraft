<?php

/*
 * ------------------------------------
 * Job Application Form Configuration
 * ------------------------------------
 */

$to    = "leon.sayasack@gmail.com"; // <--- Your email ID here

/*
 * ------------------------------------
 * END CONFIGURATION
 * ------------------------------------
 */

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$position = $_POST["position"];
$locations = isset($_POST["locations"]) ? implode(', ', $_POST["locations"]) : '';
$resume = isset($_FILES['resume']) ? $_FILES['resume'] : null;

if (isset($first_name) && isset($last_name) && isset($phone) && isset($position) && isset($locations) && isset($resume)) {
    $website = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    $headers .= "From: ".$first_name." ".$last_name." <".$email.">\r\n"."Reply-To: ".$email."\r\n" ;
    $subject = "Job Application for $position at $locations";  // Subject line

    // Move the uploaded resume to a designated directory
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($resume["name"]);
    move_uploaded_file($resume["tmp_name"], $target_file);

    // Email Content
    $msg = "Hello, <br/> <br/> You've received a new job application from $first_name $last_name ($email).<br/><br/>";
    $msg .= "Phone: $phone <br/>";
    $msg .= "Position: $position <br/>";
    $msg .= "Location(s): $locations <br/>";
    $msg .= "Resume: <a href='http://" . $_SERVER['SERVER_NAME'] . "/$target_file'>Download Resume</a> <br/><br/>";
    $msg .= "-- <br>This e-mail was sent from a job application form on $website";

    $mail =  mail($to, $subject, $msg, $headers);
    if($mail) {
        echo 'success';
    } else {
        echo 'failed';
    }
} else {
    echo 'failed';
}

?>