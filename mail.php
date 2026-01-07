<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';

function sendBookingMail($toEmail, $service, $userName, $userEmail, $date, $time, $address) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $mail->Username = 'bhushanphirke314@gmail.com';      // Your Gmail
        $mail->Password = 'tlmkuqzvejzflmgw'; // Gmail App password

        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('bhushanphirke314@gmail.com', 'Service Booking');
        $mail->addAddress($toEmail);

        $mail->isHTML(true);
        $mail->Subject = 'New Service Booking';
        $mail->Body = "
            <h3>New Booking Received</h3>
            <p><b>Service:</b> $service</p>
            <p><b>User:</b> $userName</p>
            <p><b>Email:</b> $userEmail</p>
            <p><b>Date:</b> $date</p>
            <p><b>Time:</b> $time</p>
            <p><b>Address:</b> $address</p>
        ";

        $mail->send();
        return true;

    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
?>
