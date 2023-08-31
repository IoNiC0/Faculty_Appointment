<?php
include 'auth.php';
require 'db_connect.php';


$rowId = $_POST['id'];
$newsubject = $_POST['newsubject'];
$newstiming = $_POST['newstiming'];
$newDate = $_POST['timing'];
$sql = "UPDATE appointment
    SET Subject = '$newsubject',
        sTime = '$newstiming',Timing='$newDate'
    WHERE app_id = '$rowId';";
if (mysqli_query($db_connection, $sql)) {
    echo '<script>';
    echo 'alert("Updation Successful");';
    echo 'window.location="panel.php";';
    echo '</script>';
} else {
    echo '<script>';
    echo 'alert("Updation Failed");';
    echo 'window.location="admin_app_details.php";';
    echo '</script>';
}

?>