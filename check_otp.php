<?php

include 'authentication.php';
require 'db_connect.php';


function verifyOTP($email, $otp) {
    global $db_connection;

    $sql = "SELECT * FROM user_registration WHERE email = ? AND otp = ?";
    $stmt = $db_connection->prepare($sql);
    $stmt->bind_param("ss", $email, $otp);

    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    return $user !== null;
}


if (isset($_SESSION['semail']) && isset($_POST['otp'])) {
    $email = $_SESSION['semail'];
    $submitted_otp = $_POST['otp'];

    if (verifyOTP($email, $submitted_otp)) {
        
        echo '<script>';
		echo 'alert("OTP Verified Succesfully");';
		echo 'window.location="admin.php";';
		echo '</script>';
        
    } else {
        
        echo '<script>';
		echo 'alert("Invalid OTP");';
		echo 'window.location="index.php";';
		echo '</script>';
    }
}
?>
