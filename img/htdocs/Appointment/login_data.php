<?php
    include 'db_connect.php';
    $roll = $_POST['roll'];

    $sql = "select * from user_registration where Roll = '$roll'";
    $result = mysqli_query($db_connection,$sql);
    $row = mysqli_num_rows($result);
    if($row==1)
    {
        session_start();
        $_SESSION['roll'] = $roll;
        header("Location:admin.php");

    }
    else
    {
        echo '<script>';
		echo 'alert("Roll number doesnot exist");';
		echo 'window.location="index.php";';
		echo '</script>';
    }
?>