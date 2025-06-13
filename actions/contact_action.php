<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if (isset($_POST['submitcontact'])) {

    $fullname = $_POST['full_name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'wastenot.org0@gmail.com';
        $mail->Password = 'qqnquehkrwnrhexp';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('wastenot.org0@gmail.com', 'WasteNot');
        $mail->addAddress('wastenot.org0@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = 'New Enquiry - WasteNot';
        $mail->Body = "
            <h3>New Enquiry</h3>
            <p><strong>Name:</strong> $fullname</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong> $message</p>
        ";

        $mail->send();
        $_SESSION['status'] = "Thank you for contacting us – Team WasteNot.";
    } catch (Exception $e) {
        $_SESSION['status'] = "Mailer Error: {$mail->ErrorInfo}";
    }

    header("Location: ../pages/contact.php");
    exit();
} else {
    $_SESSION['status'] = "Invalid access.";
    header("Location: ../pages/contact.php");
    exit();
}
