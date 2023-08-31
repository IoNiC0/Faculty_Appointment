<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["semail"];
    
    $checkEmailSql = "SELECT email FROM user_registration WHERE email = ?;";
    $checkEmailStmt = $db_connection->prepare($checkEmailSql);
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailResult = $checkEmailStmt->get_result();

    if ($checkEmailResult->num_rows === 1) {
        $_SESSION['semail'] = $email;
        $otp = generateOTP();

        $updateSql = "UPDATE user_registration SET OTP = ? WHERE email = ?;";
        $stmt = $db_connection->prepare($updateSql);
        $stmt->bind_param("ss", $otp, $email);

        if ($stmt->execute()) {
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';
                $mail->SMTPAuth = true;
                $mail->Username = 'your_email_address';
                $mail->Password = 'your_email_password';
                $mail->setFrom('your_email_address', 'your_name');
                $mail->addAddress($email);
                $mail->Subject = 'OTP Verification';
                $mail->Body = 'Your OTP is: ' . $otp;

                $mail->send();
                echo '<script>';
                echo 'alert("OTP has been sent to your mail address");';
                echo 'window.location="enter_otp.php";';
                echo '</script>';
            } catch (Exception $e) {
                echo "Error sending email: " . $mail->ErrorInfo;
            }
            $stmt->close();
        } else {
            echo "Error updating OTP: " . $stmt->error;
        }
    } else {
        echo "<script>";
        echo "alert('Email not found in the database');";
        echo "window.location='index.php';";
        echo "</script>";
    }

    $checkEmailStmt->close();
    $db_connection->close();
}

function generateOTP()
{
    return str_pad(mt_rand(100000, 999999), 6, '0', STR_PAD_LEFT);
}
?>
