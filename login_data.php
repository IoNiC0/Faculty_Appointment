<?php
include 'db_connect.php';
$semail = $_POST['semail'];

$sql = "select * from user_registration where email = '$semail'";
$result = mysqli_query($db_connection, $sql);
$row = mysqli_num_rows($result);
if ($row == 1) {
    session_start();
    $_SESSION['semail'] = $semail;
    header("Location:admin.php");

} else {
    echo '<script>';
    echo 'alert("Email doesnot exist");';
    echo 'window.location="index.php";';
    echo '</script>';
}
?>