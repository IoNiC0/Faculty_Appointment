<?php
require 'db_connect.php';
$f_id = $_POST['id'];
$f_name = $_POST['name'];
$f_email = $_POST['email'];
$f_password = $_POST['password'];
$f_number = $_POST['number'];
$f_address = $_POST['address'];

$sql = "INSERT INTO `faculty`(`Id`, `Name`, `Email`, `Password`, `Number`, `Address`) VALUES ('$f_id','$f_name','$f_email','" . md5($f_password) . "','$f_number','$f_address')";
// $query = "INSERT INTO `appointment`(`Faculty_Id`, `Timing`, `Subject`, `Roll`) VALUES (NULL,NULL,NULL,'$std_roll')";


if (mysqli_query($db_connection, $sql)) {
    // mysqli_query($db_connection, $query);
    echo '<script>';
    echo 'alert("Registration Succesful");';
    echo 'window.location="index.php";';
    echo '</script>';

} else {
    echo '<script>';
    echo 'alert("Registration Failed");';
    echo 'window.location="faculty_register.php";';
    echo '</script>';
}

?>