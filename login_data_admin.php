<?php
    include 'db_connect.php';
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "select * from faculty where Email = '$email' and Password = '".md5($password)."'";
    $result = mysqli_query($db_connection,$sql);
    $row = mysqli_num_rows($result);
    if($row==1)
    {
        session_start();
        $_SESSION['email'] = $email;
        header("Location:panel.php");

    }
    else
    {
        echo '<script>';
		echo 'alert("Invalid Username or Password");';
		echo 'window.location="index.php";';
		echo '</script>';
    }
?>