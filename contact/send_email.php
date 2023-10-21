<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php'; 
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php'; 

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST["message"]; // massage here
    $recipientEmail = $_POST["recipient_email"]; // get recipient email
    
    $subject = "New Messages!";
    $body = "\n$message";

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0; //  0 for production use
        $mail->isSMTP();
        $mail->Host = 'mail.example.com'; // Your SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = 'xxx@example.com'; // Your SMTP username
        $mail->Password = 'xxxxxxx'; // Your SMTP password
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption;
        $mail->Port = 465; // TCP port to connect to

        // Recipients
        $mail->setFrom('example.com', 'example'); // Your email address and name
        $mail->addAddress($recipientEmail); // Use recipient's email address and name

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Error: Invalid request.";
}

?>
