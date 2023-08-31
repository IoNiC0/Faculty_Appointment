<?php
require 'db_connect.php';
$std_name = $_POST['name'];
$std_number = $_POST['number'];
$std_course = $_POST['course'];
$std_address = $_POST['address'];
$std_email = $_POST['email'];
$std_password = $_POST['password'];

$sql = "INSERT INTO `user_registration`(`Name`, `Number`, `Course`, `Address`, `email`, `password`) VALUES ('$std_name','$std_number','$std_course','$std_address','$std_email','" . md5($std_password) . "')";
// $query = "INSERT INTO `appointment`(`Faculty_Id`, `Timing`, `Subject`, `Roll`) VALUES (NULL,NULL,NULL,'$std_roll')";


if (mysqli_query($db_connection, $sql)) {
    // mysqli_query($db_connection, $query);
    echo '<script>';
    echo 'alert("Registration Succesful");';
    echo 'window.location="test.php";';
    echo '</script>';

} else {
    echo '<script>';
    echo 'alert("Registration Failed");';
    echo 'window.location="reg_input.php";';
    echo '</script>';
}

?>