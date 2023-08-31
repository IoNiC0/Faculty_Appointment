<?php
    session_start();
    if(!isset($_SESSION['roll']))
    {
        echo'<script>';
		echo 'alert("Enter your roll number to access the page");';
		echo 'window.location="login.php";';
		echo '</script>';
    }
    else{
        $roll = $_SESSION['roll'];
    }
?>