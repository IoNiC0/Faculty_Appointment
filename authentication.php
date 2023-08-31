<?php
session_start();
if (!isset($_SESSION['semail'])) {
    echo '<script>';
    echo 'alert("Enter your email to access the page");';
    echo 'window.location="index.php";';
    echo '</script>';
} else {
    $roll = $_SESSION['semail'];
}
?>