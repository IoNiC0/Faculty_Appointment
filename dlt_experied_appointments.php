<?php
require 'db_connect.php';

$currentDate = date('Y-m-d');
$currentTime = date('H:i:s');

$query = "DELETE FROM appointment WHERE (Timing < '$currentDate') OR (Timing = '$currentDate' AND sTime < '$currentTime')";
$result = mysqli_query($db_connection, $query);

if ($result) {
    // echo "Expired appointments have been removed.";
    // continue;
} else {
    echo "Error: " . mysqli_error($db_connection);
}

mysqli_close($db_connection);
?>
