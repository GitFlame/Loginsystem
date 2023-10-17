<?php


require 'phpmailer\src\Exception.php';
require 'phpmailer\src\PHPMailer.php';
require 'phpmailer\src\SMTP.php';

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

include "connect.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
// $confirm_password = $_POST['confirmPassword'];
 $encpassword = md5($password); //using md5 for password encryption


//$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$sql = "INSERT INTO `details` (`id`,`username`, `email_id`, `password`) VALUES ('id','$username', '$email','$encpassword')";

$result = mysqli_query($conn, $sql);

if ($result) {
//php mailer code
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'priyanshu.jha@indusnet.co.in'; // SMTP username
        $mail->Password = 'dotigifmlfrpozrk'; // SMTP password
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption
        $mail->Port = 465; // TCP port to connect to

        $mail->setFrom('priyanshu.jha@indusnet.co.in', 'Priyanshu Jha');
        $mail->addAddress($email, $username); // Email and name of the recipient

        $mail->isHTML(true);
        $mail->Subject = 'Registration Successful';
        $mail->Body = 'Thank you for registering! we will assure you to give  the best experience !';

        $mail->send();
        header("Location: thankyou.html");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

//for admin only

//     $mailAdmin = new PHPMailer(true);

// try {
//     $mailAdmin->isSMTP();
//     $mailAdmin->Host       = 'smtp.gmail.com';
//     $mailAdmin->SMTPAuth   = true;
//     $mailAdmin->Username   = 'priyanshu.jha@indusnet.co.in';
//     $mailAdmin->Password   = 'dotigifmlfrpozrk';
//     $mailAdmin->SMTPSecure = 'ssl;'
//     $mailAdmin->Port= 465;

//     $mailAdmin->setFrom('priyanshu.jha@indusnet.co.in', 'Priyanshu Jha');
//     $mailAdmin->addAddress('priyanshu.jha@indusnet.co.in', 'Priyanshu Jha'); // Replace with admin's email

//     $mailAdmin->isHTML(true);
//     $mailAdmin->Subject = 'New User Registered';
//     $mailAdmin->Body    = "A new user has been registered.\n\nUsername: $username\nEmail: $email";

//     $mailAdmin->send();
//     echo 'Admin email sent successfully';
// } catch (Exception $e) {
//     echo "Admin email could not be sent. Mailer Error: {$mailAdmin->ErrorInfo}";
// }


} else {
    die(mysqli_error($conn));
}





?>