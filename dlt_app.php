<?php
include 'authentication.php';
require 'db_connect.php';

if (isset($_GET['row_id'])) {
    $RowId = $_GET['row_id'];
    $query = "DELETE FROM appointment WHERE app_id='$RowId';";
    if (mysqli_query($db_connection, $query)) {
        echo '<script>';
        echo 'alert("Deletion Succefull");';
        echo 'window.location="show_app.php";';
        echo '</script>';
    } else {
        echo '<script>';
        echo 'alert("Deletion Failed");';
        echo 'window.location="show_app.php";';
        echo '</script>';
    }
}