<?php
session_start();
if (isset($_SESSION['semail'])) {
    unset($_SESSION['semail']);
    header("location:index.php");
}
?>