<?php
include 'authentication.php';
require 'db_connect.php';


$rowId = $_POST['id'];
$newsubject = $_POST['newsubject'];
$newstiming = $_POST['newstiming'];
$sql = "UPDATE appointment
    SET Subject = '$newsubject',
        sTime = '$newstiming'
    WHERE app_id = '$rowId';";
if (mysqli_query($db_connection, $sql)) {
    echo '<script>';
    echo 'alert("Updation Successful");';
    echo 'window.location="admin.php";';
    echo '</script>';
} else {
    echo '<script>';
    echo 'alert("Updation Failed");';
    echo 'window.location="show_app.php";';
    echo '</script>';
}

?>