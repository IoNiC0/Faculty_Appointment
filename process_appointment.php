<?php
include 'authentication.php';
include 'db_connect.php';
$faculty = $_POST['faculty'];
$time = $_POST["scheduleTime"];
$subject = $_POST["subject"];
$nTime = $_POST["Time"];


$sql = "SELECT Id FROM faculty WHERE `Name` = '$faculty'";
$outcome = mysqli_query($db_connection, $sql);
if ($outcome) {
    $row = mysqli_fetch_assoc($outcome);
    $f_id = $row['Id'];
}

$query = "INSERT INTO `appointment`(`Faculty_Id`, `Timing`, `Subject`, `email`,`sTime`,`Status`) VALUES ('$f_id','$time','$subject','" . $_SESSION['semail'] . "','$nTime','Pending')";

$result = mysqli_query($db_connection, $query);
if ($result) {
    echo '<script>';
    echo 'alert("Appointment Booked Succesfully");';
    echo 'window.location="admin.php";';
    echo '</script>';

} else {
    echo '<script>';
    echo 'alert("Failed");';
    echo 'window.location="appointment.php";';
    echo '</script>';
}

?>