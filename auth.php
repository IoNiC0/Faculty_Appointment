<?php
session_start();
if (!isset($_SESSION['email'])) {
    echo '<script>';
    echo 'alert("Enter your email to access the page");';
    echo 'window.location="index.php";';
    echo '</script>';
} else {
    $email = $_SESSION['email'];
}
?>